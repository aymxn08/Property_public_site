<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\ProjectTypeModel;
use App\Models\ProjectImageModel;
use App\Models\EnquiryModel;

class Projects extends BaseController
{
    protected $projectModel;
    protected $typeModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->typeModel    = new ProjectTypeModel();
    }

    // ---------------------------------------------------------------
    // Global marketplace listing (all companies, with filters)
    // ---------------------------------------------------------------
    public function index()
    {
        $type     = $this->request->getGet('type');
        $location = $this->request->getGet('location');
        $sort     = $this->request->getGet('sort');
        $minPrice = $this->request->getGet('min_price');
        $maxPrice = $this->request->getGet('max_price');

        $query = $this->projectModel
            ->select('projects.*, project_types.type_name as category,
                      companies.company_name, companies.slug as company_slug,
                      (SELECT image_path FROM project_images WHERE project_id = projects.id ORDER BY id ASC LIMIT 1) as thumb')
            ->join('project_types', 'project_types.id = projects.project_type_id')
            ->join('companies',     'companies.id = projects.company_id')
            ->where('projects.status', 'Active');

        if ($type) {
            $query->where('project_types.type_name', $type);
        }

        if ($location) {
            $query->like('projects.address', $location);
        }

        if ($minPrice && is_numeric($minPrice)) {
            $query->where('projects.price_start >=', (int)$minPrice);
        }

        if ($maxPrice && is_numeric($maxPrice)) {
            $query->where('projects.price_start <=', (int)$maxPrice);
        }

        // Sorting
        if ($sort === 'price_low') {
            $query->orderBy('projects.price_start', 'ASC');
        } elseif ($sort === 'price_high') {
            $query->orderBy('projects.price_start', 'DESC');
        } elseif ($sort === 'popular') {
            // popularity = enquiry count
            $query->select('COUNT(e.id) as enq_count')
                  ->join('enquiries e', 'e.project_id = projects.id', 'left')
                  ->groupBy('projects.id')
                  ->orderBy('enq_count', 'DESC');
        } else {
            $query->orderBy('projects.created_at', 'DESC');
        }

        return view('pages/projects', [
            'title'           => 'Browse All Properties',
            'projects'        => $query->paginate(9, 'default'),
            'pager'           => $query->pager,
            'types'           => $this->typeModel->findAll(),
            'currentType'     => $type,
            'currentLocation' => $location,
            'currentSort'     => $sort,
            'minPrice'        => $minPrice,
            'maxPrice'        => $maxPrice,
        ]);
    }

    // ---------------------------------------------------------------
    // Single project detail page with dynamic fields + company info
    // ---------------------------------------------------------------
    public function details($slug)
    {
        $db = \Config\Database::connect();

        $project = $db->table('projects p')
            ->select('p.*, pt.type_name as category,
                      c.company_name, c.slug as company_slug, c.about as company_about,
                      c.logo as company_logo, c.contact_number as company_phone, c.email as company_email')
            ->join('project_types pt', 'pt.id = p.project_type_id')
            ->join('companies c',      'c.id = p.company_id')
            ->where('p.slug', $slug)
            ->where('p.status', 'Active')
            ->get()
            ->getRowArray();

        if (!$project) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Images
        $imageModel = new ProjectImageModel();
        $images = $imageModel->where('project_id', $project['id'])->findAll();

        // Dynamic field values for this project
        $fields = $db->table('project_type_fields ptf')
            ->select('ptf.id, ptf.field_name, ptf.field_type, ptf.field_group, ptf.options_json, ptf.is_active,
                      pfv.value as existing_value')
            ->join('project_field_values pfv', 'pfv.project_type_field_id = ptf.id AND pfv.project_id = ' . $project['id'], 'left')
            ->where('ptf.project_type_id', $project['project_type_id'])
            ->groupStart()
                ->where('ptf.is_active', 1)
                ->orWhere('pfv.value IS NOT NULL')
            ->groupEnd()
            ->orderBy('ptf.field_group', 'ASC')
            ->orderBy('ptf.id', 'ASC')
            ->get()
            ->getResultArray();

        // Group fields: Property Specifications / Amenities / Other
        $groupedFields = [];
        foreach ($fields as $f) {
            if (empty($f['existing_value']) && !$f['is_active']) continue; // skip empty legacy
            $g = $f['field_group'] ?: 'Other';
            $groupedFields[$g][] = $f;
        }

        return view('pages/details', [
            'title'         => $project['project_name'] . ' | ' . $project['company_name'],
            'project'       => $project,
            'images'        => $images,
            'groupedFields' => $groupedFields,
        ]);
    }

    // ---------------------------------------------------------------
    // Submit enquiry (AJAX)
    // ---------------------------------------------------------------
    public function submitEnquiry()
    {
        if (strtolower($this->request->getMethod()) !== 'post') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request']);
        }

        $projectId = $this->request->getPost('project_id');
        $project   = $this->projectModel->find($projectId);

        if (!$project) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Project not found.']);
        }

        $enquiryModel = new EnquiryModel();
        $data = [
            'project_id' => $projectId,
            'company_id' => $project['company_id'],
            'status'     => 'New',
            'name'       => $this->request->getPost('name'),
            'phone'      => $this->request->getPost('phone'),
            'email'      => $this->request->getPost('email'),
            'message'    => $this->request->getPost('message'),
        ];

        if ($enquiryModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Thank you! Your enquiry has been submitted.']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Something went wrong. Please try again.']);
    }

    public function explore()
    {
        return $this->index();
    }
}
