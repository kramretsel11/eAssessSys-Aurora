<?php

namespace App\Controllers;

use App\Models\AssessmentLevelModel;
use CodeIgniter\RESTful\ResourceController;

class AssessmentLevelController extends ResourceController
{
    protected $assessmentLevelModel;

    public function __construct()
    {
        $this->assessmentLevelModel = new AssessmentLevelModel();
        helper(['form', 'url']);
    }

    public function getAssessmentLevels()
    {
        $assessmentLevels = $this->assessmentLevelModel->getAssessmentLevels();
        return $this->respond([
            'status' => 200,
            'data' => $assessmentLevels
        ]);
    }

    public function createAssessmentLevel()
    {
        $json = json_decode($this->request->getBody());
        $data = [
            'categoryId' => $json->categoryId,
            'assessmentClass' => $json->assessmentClass,
            'overValue' => $json->overValue,
            'notOverValue' => $json->notOverValue,
            'assessmentLevel' => $json->assessmentLevel,
            'description' => $json->description,
            'created_by' => $json->created_by
        ];

        $this->assessmentLevelModel->insert($data);

        return $this->respond([
            'status' => 200,
            'message' => 'Assessment Level created successfully'
        ]);
    }

    public function updateAssessmentLevel()
    {
        $json = json_decode($this->request->getBody());
        $id = $json->id;
        $data = [
            'categoryId' => $json->categoryId,
            'assessmentClass' => $json->assessmentClass,
            'overValue' => $json->overValue,
            'notOverValue' => $json->notOverValue,
            'assessmentLevel' => $json->assessmentLevel,
            'description' => $json->description
        ];

        $this->assessmentLevelModel->update($id, $data);

        return $this->respond([
            'status' => 200,
            'message' => 'Assessment Level updated successfully'
        ]);
    }

    public function deleteAssessmentLevel()
    {
        $json = json_decode($this->request->getBody());
        $id = $json->id;
        $this->assessmentLevelModel->delete($id);

        return $this->respond([
            'status' => 200,
            'message' => 'Assessment Level deleted successfully'
        ]);
    }
}