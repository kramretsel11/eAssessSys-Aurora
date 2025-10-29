<?php

namespace App\Controllers;

use App\Models\MarketValueModel;
use CodeIgniter\RESTful\ResourceController;

class MarketValueController extends ResourceController
{
    protected $marketValueModel;

    public function __construct()
    {
        $this->marketValueModel = new MarketValueModel();
        helper(['form', 'url']);
    }

    public function getMarketValues()
    {
        $marketValues = $this->marketValueModel->getMarketValues();
        return $this->respond([
            'status' => 200,
            'data' => $marketValues
        ]);
    }

    public function createMarketValue()
    {
        $json = json_decode($this->request->getBody());
        $data = [
            'categoryId' => $json->categoryId,
            'municipality' => $json->municipality,
            'kindOfLand' => $json->kindOfLand,
            'categoryClass' => $json->categoryClass,
            'unit' => $json->unit,
            'marketValue' => $json->marketValue,
            'created_by' => $json->created_by
        ];

        $this->marketValueModel->insert($data);

        return $this->respond([
            'status' => 200,
            'message' => 'Market Value created successfully'
        ]);
    }

    public function updateMarketValue()
    {
        $json = json_decode($this->request->getBody());
        $id = $json->id;
        $data = [
            'categoryId' => $json->categoryId,
            'municipality' => $json->municipality,
            'kindOfLand' => $json->kindOfLand,
            'categoryClass' => $json->categoryClass,
            'unit' => $json->unit,
            'marketValue' => $json->marketValue
        ];

        $this->marketValueModel->update($id, $data);

        return $this->respond([
            'status' => 200,
            'message' => 'Market Value updated successfully'
        ]);
    }

    public function deleteMarketValue()
    {
        $json = json_decode($this->request->getBody());
        $id = $json->id;
        $this->marketValueModel->delete($id);

        return $this->respond([
            'status' => 200,
            'message' => 'Market Value deleted successfully'
        ]);
    }
}