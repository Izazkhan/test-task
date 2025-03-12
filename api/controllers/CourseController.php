<?php
// CourseController.php
require_once 'models/Course.php';

class CourseController {
    public function getCourses() {
        // Logic for fetching course by ID
        $courses = Course::all();
        return jsonResponse($courses, 200);
    }
    
    public function getCourseById($id) {
        // Logic for fetching course by ID
        $course = Course::find($id);
        return jsonResponse($course);
    }
    
    public function getCourseByCategory($id) {
        // Logic for fetching course by ID
        $course = Course::getByCategory($id);
        return jsonResponse($course);
    }
}
