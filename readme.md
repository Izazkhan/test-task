# Fullstack Tech Task

This project is a fullstack application that implements a clean and structured router system, RESTful APIs, and efficient database queries to manage categories and courses. Below is the detailed explanation of the setup instructions, solution approach, APIs, architecture and issues faced during development.

---

## Setup Instructions
#### How to run project:
```bash

docker-compose up --build
```

The pdo_mysql extension was missing initially. It was added to the API container using the appropriate command.the command is added to docker-compose.yml file
```yaml
services:
    api:
        command: >
          bash -c "docker-php-ext-install pdo pdo_mysql &&
               a2enmod rewrite &&
               docker-php-entrypoint apache2-foreground"
```

#### Migrating Data
To migrate the initial data into the database, run the following commands:

```bash

docker exec -i kc-fullstack-dev-tech-task-db-1 mysql -u test_user -ptest_password course_catalog < database/migrations/categories.sql
docker exec -i kc-fullstack-dev-tech-task-db-1 mysql -u test_user -ptest_password course_catalog < database/migrations/courses.sql
```
---
*** Please check ```docker ps ``` for container name ***

## Solution Approach

#### Router System
I created a router system to handle clean and beautiful URLs such as `/categories/{id}` and `/categories/{id}/courses`. This ensures the application has a well-structured and user-friendly URL schema.

#### RESTful APIs
The APIs were designed according to the specifications provided in the Swagger YAML file. The focus was on minimizing the number of database queries for a single API call to improve performance.

#### Architecture
The application is built using Object-Oriented Programming (OOP) concepts. While the architecture could be further refined, the current implementation is sufficient for the task requirements.

#### Router System Explanation
The router system is designed to handle clean and structured URLs. It dynamically routes requests to the appropriate controller methods based on the URL pattern. For example:

/categories/{id} routes to CategoryController@getById.

/categories/{id}/courses routes to CourseController@getCourseByCategory.

This ensures the application remains scalable and maintainable.

---

## APIs

The following APIs are implemented:

1. **GET `/all-categories-and-courses`**  
   - **Description**: Loads all categories and their associated courses. This is used for the initial load of the application.
   - **Controller**: `HomeController@getCategoriesWithCourses`

2. **GET `/categories`**  
   - **Description**: Retrieves all categories along with the count of courses in each category (including child categories).
   - **Controller**: `CategoryController@getAll`

3. **GET `/categories/{id}`**  
   - **Description**: Retrieves a single category by its ID, including the count of courses (including child categories).
   - **Controller**: `CategoryController@getById`

4. **GET `/categories/{id}/courses`**  
   - **Description**: Retrieves all courses belonging to a specific category, including the main category name.
   - **Controller**: `CourseController@getCourseByCategory`

5. **GET `/courses`**  
   - **Description**: Retrieves all courses along with their main category names.
   - **Controller**: `CourseController@getCourses`

6. **GET `/courses/{id}`**  
   - **Description**: Retrieves a single course by its ID, including the main category name.
   - **Controller**: `CourseController@getCourseById`

## Confusion in Task Requirements  

As per the task description:  

> "By clicking on a category, only courses from that category should be displayed."  
> "If a category has courses, the count of courses should be displayed, and the value should include courses in child categories."

I assumed that **since we are showing counts for child category courses**, we might also need to **display those child category courses** when selecting the parent category.

- **To test this behavior**, run:

```bash
git checkout 6f6e03532a1737849c701e744db3df85d6be19f0
```

- **To revert to the default behavior (only displaying courses for the selected category)**, run:

```bash
git checkout master
```

## Performance of queries


## Conclusion  
This project demonstrates a clean and efficient approach to building a fullstack application with a focus on structured URLs, RESTful APIs, and optimized database queries. The architecture is built using OOP concepts, ensuring readability and maintainability. 
