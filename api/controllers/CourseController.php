<?php
// CourseController.php
require_once 'models/Course.php';

class CourseController {
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
    
    public function getCourseByCategory($id) {
        try {
            // Logic for fetching course by ID
            $course = Course::getAllByCategoryIds([$id]);
            return jsonResponse($course);
        } catch (\Exception $e) {
            return jsonResponse([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
