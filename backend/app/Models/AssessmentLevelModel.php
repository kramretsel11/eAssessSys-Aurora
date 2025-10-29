<?php

namespace App\Models;

use CodeIgniter\Model;

class AssessmentLevelModel extends Model
{
    protected $table = 'tblassessment_levels';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'categoryId',
        'assessmentClass',
        'overValue',
        'notOverValue',
        'assessmentLevel',
        'description',
        'created_by'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAssessmentLevels()
    {
        return $this->select('tblassessment_levels.*, tblcategory.name as category_name')
                    ->join('tblcategory', 'tblcategory.id = tblassessment_levels.categoryId')
                    ->findAll();
    }

    public function getAssessmentLevelById($id)
    {
        return $this->find($id);
    }
}