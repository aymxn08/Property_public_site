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
        $this->typeModel = new ProjectTypeModel();
    }

    public function index()
    {
        $type = $this->request->getGet('type');
        $location = $this->request->getGet('location');
        $sort = $this->request->getGet('sort');

        $query = $this->projectModel->select('projects.*, project_types.type_name as category')
                                   ->join('project_types', 'project_types.id = projects.project_type_id')
                                   ->where('projects.status', 'Active');

        if ($type) {
            $query->where('project_types.type_name', $type);
        }

        if ($location) {
            $query->like('projects.address', $location);
        }

        if ($sort == 'price_low') {
            $query->orderBy('starting_price', 'ASC');
        } elseif ($sort == 'price_high') {
            $query->orderBy('starting_price', 'DESC');
        } else {
            $query->orderBy('projects.created_at', 'DESC');
        }

        $data = [
            'title' => 'Browse Projects',
            'projects' => $query->paginate(9, 'default'),
            'pager' => $query->pager,
            'types' => $this->typeModel->findAll(),
            'currentType' => $type,
            'currentLocation' => $location,
            'currentSort' => $sort
        ];

        return view('pages/projects', $data);
    }

    public function details($slug)
    {
        $project = $this->projectModel->select('projects.*, project_types.type_name as category')
                                     ->join('project_types', 'project_types.id = projects.project_type_id')
                                     ->where('slug', $slug)
                                     ->first();

        if (!$project) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $imageModel = new ProjectImageModel();
        
        $data = [
            'title' => $project['project_name'],
            'project' => $project,
            'images' => $imageModel->where('project_id', $project['id'])->findAll()
        ];

        return view('pages/details', $data);
    }

    public function submitEnquiry()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request']);
        }

        $enquiryModel = new EnquiryModel();
        
        $data = [
            'project_id' => $this->request->getPost('project_id'),
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
