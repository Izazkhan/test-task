<?php

require_once 'models/Category.php';
require_once 'models/Course.php';

class HomeController
{
    /**
     * Get all categories with courses
     * 
     * @return array
     */
    public function getCategoriesWithCourses()
    {
        try {
            // Fetch all categories
            $ids = [];
            $categories = Category::getAll();
            foreach($categories as $cat) {
                if ($cat['parent_id'] == null)
                $ids[] = $cat['category_id'];
            }
            // Fetch all courses that belong to any category
            $courses = Course::getAllByCategoryIds($ids);
            // Return combined data
            return jsonResponse([
                'categories' => $categories,
                'courses' => $courses
            ]);
        } catch (\Exception $e) {
            return jsonResponse([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
