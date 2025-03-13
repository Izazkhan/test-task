<?php

require_once 'Database.php';

class Course
{
    public function __construct() {}

    // Static Method to Find Course by ID
    public static function find($id)
    {
        $stmt = Database::getInstance()->getConnection()->prepare("
            WITH RECURSIVE parent_tree AS (
                SELECT c.id, c.parent_id, c.name
                FROM categories c
                JOIN courses co ON c.id = co.category_id
                WHERE co.id = :id
                UNION
                SELECT c.id, c.parent_id, c.name
                FROM categories c
                JOIN parent_tree pt ON c.id = pt.parent_id
            )
            SELECT 
                co.*,
                (SELECT name FROM parent_tree WHERE parent_id IS NULL) AS main_category_name
            FROM courses co
            WHERE co.id = :cid
        ");
        $stmt->execute([':id' => $id, ':cid' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null; // Return null if no course is found
    }

    public static function all()
    {
        $stmt = Database::getInstance()->getConnection()->query("SELECT * FROM courses");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllByCategoryIds($categoryIds)
    {
        if (empty($categoryIds)) {
            return [];
        }
        // Prepare placeholders for IN clause
        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
        $stmt = Database::getInstance()->getConnection()->prepare("
            WITH RECURSIVE category_tree AS (
                SELECT id, parent_id, name AS category_name, name AS main_category_name
                FROM categories
                WHERE id IN ($placeholders)  

                UNION ALL

                -- Recursively find all subcategories
                SELECT c.id, c.parent_id, c.name as category_name, ct.main_category_name
                FROM categories c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT
                co.*,
                ct.category_name AS category_name, 
                ct.main_category_name AS main_category_name
            FROM courses co
            JOIN category_tree ct ON co.category_id = ct.id;

        ");
        $stmt->execute($categoryIds);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
