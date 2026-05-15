<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\ProjectModel;
use App\Models\ProjectTypeModel;

class Builders extends BaseController
{
    protected $companyModel;
    protected $projectModel;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
        $this->projectModel = new ProjectModel();
    }

    /**
     * Public: List all active/approved builders
     */
    public function index()
    {
        $db = \Config\Database::connect();

        // Fetch approved, non-deleted companies with their project + enquiry count
        $companies = $db->table('companies c')
            ->select('c.id, c.slug, c.company_name, c.logo, c.about, c.contact_number, c.email, c.address')
            ->select('COUNT(DISTINCT p.id) as project_count')
            ->select('COUNT(DISTINCT e.id) as enquiry_count')
            ->join('projects p', 'p.company_id = c.id AND p.status = "Active"', 'left')
            ->join('enquiries e', 'e.company_id = c.id', 'left')
            ->where('c.is_deleted', 0)
            ->where('c.status', 'Approved')
            ->groupBy('c.id')
            ->orderBy('project_count', 'DESC')
            ->get()
            ->getResultArray();

        return view('pages/builders/index', [
            'title'     => 'Top Property Builders & Developers',
            'companies' => $companies,
        ]);
    }

    /**
     * Public: Single builder profile page with their projects + filters
     */
    public function details($slug)
    {
        $db = \Config\Database::connect();

        // Fetch the company by slug
        $company = $db->table('companies')
            ->where('slug', $slug)
            ->where('is_deleted', 0)
            ->where('status', 'Approved')
            ->get()
            ->getRowArray();

        if (!$company) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Filters from query string
        $type     = $this->request->getGet('type');
        $minPrice = $this->request->getGet('min_price');
        $maxPrice = $this->request->getGet('max_price');
        $sort     = $this->request->getGet('sort');

        // Build project query — enforce company_id
        $query = $this->projectModel
            ->select('projects.*, project_types.type_name as category, COALESCE(projects.cover_image, (SELECT image_path FROM project_images WHERE project_id = projects.id ORDER BY id ASC LIMIT 1)) as thumb')
            ->join('project_types', 'project_types.id = projects.project_type_id')
            ->where('projects.company_id', $company['id'])
            ->where('projects.status', 'Active');

        if ($type) {
            $query->where('project_types.type_name', $type);
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
            $query->select('COUNT(e.id) as enq_count')
                  ->join('enquiries e', 'e.project_id = projects.id', 'left')
                  ->groupBy('projects.id')
                  ->orderBy('enq_count', 'DESC');
        } else {
            $query->orderBy('projects.created_at', 'DESC');
        }

        $typeModel = new ProjectTypeModel();

        return view('pages/builders/details', [
            'title'       => $company['company_name'] . ' — Projects',
            'company'     => $company,
            'projects'    => $query->paginate(9, 'default'),
            'pager'       => $query->pager,
            'types'       => $typeModel->findAll(),
            'currentType' => $type,
            'minPrice'    => $minPrice,
            'maxPrice'    => $maxPrice,
            'currentSort' => $sort,
        ]);
    }
}
