<?php
require_once 'models/Category.php';

class CategoryController
{
    public function getAllCategories()
    {
        return jsonResponse(Category::getAll(), 200);
    }

    public function getCategoryById($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return jsonResponse(['error' => "Record not found with id: {$id}"], 404);
        }
        return jsonResponse($category);
    }

}
