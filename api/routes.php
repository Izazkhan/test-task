<?php

require 'controllers/CourseController.php';
require 'controllers/CategoryController.php';
require 'controllers/HomeController.php';
// routes.php
require 'router.php';

route('GET', '/all-categories-and-courses', 'HomeController@getCategoriesWithCourses');
route('GET', '/categories', 'CategoryController@getAll');
route('GET', '/categories/{id}', 'CategoryController@getById');
route('GET', '/categories/{id}/courses', 'CourseController@getCourseByCategory');
route('GET', '/courses', 'CourseController@getCourses');
route('GET', '/courses/{id}', 'CourseController@getCourseById');