<?php

require_once 'Database.php';

class Category
{

    public static function getAll()
    {
        // join with courses
        $query = "WITH RECURSIVE category_tree AS (
                -- Start with all categories
                SELECT id, parent_id FROM categories 
                UNION ALL
                -- Recursively find child categories
                SELECT c.id, c.parent_id FROM categories c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT 
                c.id AS category_id,
                c.name AS category_name,
                c.parent_id,
                -- Count only courses that belong directly to the category
                (SELECT COUNT(*) FROM courses co WHERE co.category_id = c.id) AS direct_course_count,
                -- Count all courses that belong to the category and its subcategories
                (SELECT COUNT(*) FROM courses co WHERE co.category_id IN (
                    SELECT id FROM category_tree WHERE id = c.id OR parent_id = c.id
                )) AS count_of_courses
            FROM categories c
            ORDER BY c.name
        ";
        $stmt = Database::getInstance()->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $query = "WITH RECURSIVE category_tree AS (
                -- Start with all categories
                SELECT id, parent_id FROM categories 
                UNION ALL
                -- Recursively find child categories
                SELECT c.id, c.parent_id FROM categories c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT 
                c.id AS category_id,
                c.name AS category_name,
                c.parent_id,
                -- Count only courses that belong directly to the category
                -- (SELECT COUNT(*) FROM courses co WHERE co.category_id = c.id) AS direct_course_count,
                -- Count all courses that belong to the category and its subcategories
                (SELECT COUNT(*) FROM courses co WHERE co.category_id IN (
                    SELECT id FROM category_tree WHERE id = c.id OR parent_id = c.id
                )) AS count_of_courses
            FROM categories c
            WHERE c.id = :id
            ORDER BY c.name";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
