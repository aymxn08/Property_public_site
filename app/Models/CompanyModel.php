<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table            = 'companies';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;

    // Filter by is_deleted status for active companies only
    public function findAll(?int $limit = null, int $offset = 0)
    {
        $this->builder()->where('is_deleted', 0)->where('status', 'Approved');
        return parent::findAll($limit, $offset);
    }
}
