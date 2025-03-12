<?php

require 'controllers/CourseController.php';
require 'controllers/CategoryController.php';
// routes.php
require 'router.php';

route('GET', '/categories', 'CategoryController@getAllCategories');
route('GET', '/category/{id}', 'CategoryController@getCategoryById');
route('GET', '/category/{id}/courses', 'CourseController@getCourseByCategory');
route('GET', '/courses', 'CourseController@getCourses');
route('GET', '/courses/{id}', 'CourseController@getCourseById');