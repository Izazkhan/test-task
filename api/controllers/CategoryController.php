<?php
require_once 'models/Category.php';

class CategoryController
{
    public function getAll()
    {
        try {
            return jsonResponse(Category::getAll(), 200);
        } catch (\Exception $e) {
            return jsonResponse([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getById($id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return jsonResponse(['message' => "Record not found with id: {$id}"], 404);
            }
            return jsonResponse($category);
        } catch (\Exception $e) {
            return jsonResponse([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
