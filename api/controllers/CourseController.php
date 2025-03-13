<?php
// CourseController.php
require_once 'models/Course.php';

/**
 * Course controller
 */
class CourseController {
    /**
     * Get all courses
     * 
     * @return array
     */
    public function getCourses() {
        try {
            // Logic for fetching course by ID
            $courses = Course::all();
            return jsonResponse($courses, 200);
        } catch (\Exception $e) {
            return jsonResponse([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get a course by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function getCourseById($id) {
        try {
            // Logic for fetching course by ID
            $course = Course::find($id);
            return jsonResponse($course);
        } catch (\Exception $e) {
            return jsonResponse([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get courses by category ID
     * 
     * @param int $id
     * @return array
     */
    public function getCourseByCategory($id) {
        try {
            // Logic for fetching course by ID
            $course = Course::getByCategoryId($id);
            return jsonResponse($course);
        } catch (\Exception $e) {
            return jsonResponse([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
