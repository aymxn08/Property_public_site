<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table            = 'projects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'company_id', 
        'project_type_id', 
        'project_name', 
        'address', 
        'latitude',
        'longitude',
        'price_start',
        'price_end',
        'starting_price', 
        'number_of_units', 
        'status',
        'slug'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get projects with their type info
     */
    public function getProjectsWithType($limit = null, $offset = 0)
    {
        $builder = $this->db->table($this->table);
        $builder->select('projects.*, project_types.type_name as category');
        $builder->join('project_types', 'project_types.id = projects.project_type_id');
        $builder->where('projects.status', 'Active');
        
        if ($limit) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResultArray();
    }
}
