<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectImageModel extends Model
{
    protected $table            = 'project_images';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['project_id', 'image_path', 'created_at'];
}
