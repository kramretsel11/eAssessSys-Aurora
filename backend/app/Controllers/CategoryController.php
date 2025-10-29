<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\RESTful\ResourceController;

class CategoryController extends ResourceController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        helper(['form', 'url']);
    }

    public function getCategories()
    {
        $categories = $this->categoryModel->getCategories();
        return $this->respond([
            'status' => 200,
            'data' => $categories
        ]);
    }

    public function createCategory()
    {
        try {
            $requestData = json_decode($this->request->getBody());
            
            // Validate required fields
            if (!isset($requestData->name) || !isset($requestData->type)) {
                return $this->respond([
                    'status' => 400,
                    'message' => 'Name and type are required fields'
                ], 400);
            }

            $data = [
                'name' => $requestData->name,
                'type' => $requestData->type,
                'created_by' => 1 // Default to 1 if not provided
            ];

            // If created_by is provided in the request, use it
            if (isset($requestData->created_by)) {
                $data['created_by'] = $requestData->created_by;
            }

            $inserted = $this->categoryModel->insert($data);

            if (!$inserted) {
                return $this->respond([
                    'status' => 500,
                    'message' => 'Failed to create category'
                ], 500);
            }

            return $this->respond([
                'status' => 200,
                'message' => 'Category created successfully'
            ]);
        } catch (\Exception $e) {
            log_message('error', '[CategoryController::createCategory] ' . $e->getMessage());
            return $this->respond([
                'status' => 500,
                'message' => 'An error occurred while creating the category'
            ], 500);
        }
    }

    public function updateCategory()
    {
        $requestData = json_decode($this->request->getBody());
        $id = $requestData->id;
        $data = [
            'name' => $requestData->name,
            'type' => $requestData->type
        ];

        $this->categoryModel->update($id, $data);

        return $this->respond([
            'status' => 200,
            'message' => 'Category updated successfully'
        ]);
    }

    public function deleteCategory()
    {
        $requestData = json_decode($this->request->getBody());
        $id = $requestData->id;
        $this->categoryModel->delete($id);

        return $this->respond([
            'status' => 200,
            'message' => 'Category deleted successfully'
        ]);
    }
}