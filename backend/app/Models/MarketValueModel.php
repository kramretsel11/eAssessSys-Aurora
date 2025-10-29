<?php

namespace App\Models;

use CodeIgniter\Model;

class MarketValueModel extends Model
{
    protected $table = 'tblmarket_values';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'categoryId', 
        'municipality', 
        'kindOfLand', 
        'categoryClass',
        'unit',
        'marketValue',
        'created_by'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getMarketValues()
    {
        return $this->select('tblmarket_values.*, tblcategory.name as category_name')
                    ->join('tblcategory', 'tblcategory.id = tblmarket_values.categoryId')
                    ->findAll();
    }

    public function getMarketValueById($id)
    {
        return $this->find($id);
    }
}