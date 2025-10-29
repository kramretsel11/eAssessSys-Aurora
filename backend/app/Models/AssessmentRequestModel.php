<?php

namespace App\Models;

use CodeIgniter\Model;

class AssessmentRequestModel extends Model
{
    protected $table = 'tblassessment_requests';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'arpNo','pin','assessmentLevelId','ownerName','marriedTo','ownerAddress','contactNo','tin',
        'adminName','adminMarriedTo','adminAddress','adminContactNo','adminTin',
        'street','barangay','municipality','province','octTctCloaNo','surveyNo','lotNo','areaNo',
        'generalDescription','structuralChecklist','additionalItems','propertyAppraisal','propertyBounderies',
        'landAppraisal','otherImprovements','propertyAssessment','appraisedBy','recommendingApproval','approvedBy',
        'appraisedDate','recommendDate','approvedDate','memorada','requestStatus'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
