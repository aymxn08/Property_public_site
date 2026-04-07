<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\ProjectTypeModel;

class Home extends BaseController
{
    public function index()
    {
        $projectModel = new ProjectModel();
        $typeModel = new ProjectTypeModel();

        $data = [
            'title' => 'Home',
            'featuredProjects' => $projectModel->getProjectsWithType(6),
            'propertyTypes' => $typeModel->findAll()
        ];

        return view('pages/home', $data);
    }
}
