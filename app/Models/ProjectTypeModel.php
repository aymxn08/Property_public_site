<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectTypeModel extends Model
{
    protected $table            = 'project_types';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['type_name', 'status'];
}
