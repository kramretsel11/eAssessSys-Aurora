<?php

namespace App\Controllers;

use App\Models\AssessmentRequestModel;
use CodeIgniter\RESTful\ResourceController;

class AssessmentRequestController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AssessmentRequestModel();
        helper(['url']);
    }

    // List all assessment requests
    public function getRequests()
    {
        $data = $this->model->orderBy('id', 'DESC')->findAll();

        // decode JSON fields for client convenience
        $jsonFields = ['generalDescription','structuralChecklist','additionalItems','propertyAppraisal','propertyBounderies','landAppraisal','otherImprovements','propertyAssessment','requestStatus'];
        foreach ($data as &$row) {
            foreach ($jsonFields as $f) {
                if (isset($row[$f]) && is_string($row[$f])) {
                    $decoded = json_decode($row[$f], true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $row[$f] = $decoded;
                    }
                }
            }
        }

        return $this->respond(['status' => 200, 'data' => $data]);
    }

    // Get single request by id
    public function getRequest($id = null)
    {
        if (!$id) {
            return $this->respond(['status' => 400, 'message' => 'Missing id']);
        }

        $row = $this->model->find($id);
        if (!$row) {
            return $this->respond(['status' => 404, 'message' => 'Not found']);
        }

        $jsonFields = ['generalDescription','structuralChecklist','additionalItems','propertyAppraisal','propertyBounderies','landAppraisal','otherImprovements','propertyAssessment','requestStatus'];
        foreach ($jsonFields as $f) {
            if (isset($row[$f]) && is_string($row[$f])) {
                $decoded = json_decode($row[$f], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $row[$f] = $decoded;
                }
            }
        }

        return $this->respond(['status' => 200, 'data' => $row]);
    }

    // Create a new assessment request (no validation per requirements)
    public function createRequest()
    {
        $req = json_decode($this->request->getBody());

        // Ensure object/array fields are stored as JSON strings
        $payload = [];
        foreach ((array)$req as $k => $v) {
            if (in_array($k, ['generalDescription','structuralChecklist','additionalItems','propertyAppraisal','propertyBounderies','landAppraisal','otherImprovements','propertyAssessment','requestStatus'])) {
                $payload[$k] = is_null($v) ? null : json_encode($v);
            } else {
                $payload[$k] = $v;
            }
        }

        $this->model->insert($payload);
        return $this->respond(['status' => 200, 'message' => 'Assessment request created']);
    }

    // Update an existing assessment request
    public function updateRequest()
    {
        $req = json_decode($this->request->getBody());
        $id = $req->id ?? null;
        if (!$id) {
            return $this->respond(['status' => 400, 'message' => 'Missing id']);
        }

        $payload = [];
        foreach ((array)$req as $k => $v) {
            if ($k === 'id') continue;
            if (in_array($k, ['generalDescription','structuralChecklist','additionalItems','propertyAppraisal','propertyBounderies','landAppraisal','otherImprovements','propertyAssessment','requestStatus'])) {
                $payload[$k] = is_null($v) ? null : json_encode($v);
            } else {
                $payload[$k] = $v;
            }
        }

        $this->model->update($id, $payload);
        return $this->respond(['status' => 200, 'message' => 'Assessment request updated']);
    }

    // Update only requestStatus
    public function updateRequestStatus()
    {
        $req = json_decode($this->request->getBody());
        $id = $req->id ?? null;
        $status = $req->requestStatus ?? null;
        if (!$id) {
            return $this->respond(['status' => 400, 'message' => 'Missing id']);
        }

        $payload = ['requestStatus' => is_null($status) ? null : json_encode($status)];
        $this->model->update($id, $payload);
        return $this->respond(['status' => 200, 'message' => 'Request status updated']);
    }
}
