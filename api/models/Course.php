<?php

require_once 'Database.php';

/**
 * Course model
 */
class Course
{
    public function __construct() {}

    /**
     * Get a course by ID
     * 
     * @param int $id
     * @return array|null
     */
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

    /**
     * Get all courses
     * 
     * @return array
     */
    public static function all()
    {
        $stmt = Database::getInstance()->getConnection()->query(
            "SELECT * FROM courses"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all courses by category ids
     * 
     * @param array $categoryIds
     * @return array
     */
    public static function getAllByCategoryIds($categoryIds)
    {
        if (empty($categoryIds)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));

        $stmt = Database::getInstance()->getConnection()->prepare(
            "WITH RECURSIVE category_tree AS (
                SELECT id, parent_id, name AS category_name, name AS main_category_name
                FROM categories
                WHERE id IN ($placeholders)  

                UNION ALL
                SELECT c.id, c.parent_id, c.name as category_name, ct.main_category_name
                FROM categories c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT
                co.*,
                ct.category_name AS category_name, 
                ct.main_category_name AS main_category_name
            FROM courses co
            JOIN category_tree ct ON co.category_id = ct.id"
        );
        $stmt->execute($categoryIds);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a course by category and its sub categories
     * 
     * @param int $id
     * @return array|null
     */
    public static function getByCategoryAndItsSubCategories($categoryId)
    {
        $stmt = Database::getInstance()->getConnection()->prepare(
            "WITH RECURSIVE parent_tree AS (
                SELECT id, parent_id, name
                FROM categories
                WHERE id = ?
                UNION
                SELECT c.id, c.parent_id, c.name
                FROM categories c
                JOIN parent_tree pt ON c.id = pt.parent_id
            ),
            category_tree AS (
                SELECT id, (
                    SELECT name 
                    FROM parent_tree 
                    WHERE parent_id IS NULL
                ) AS main_category_name
                FROM categories
                WHERE id = ?
                UNION
                SELECT c.id, ct.main_category_name
                FROM categories c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT * FROM courses co
            JOIN category_tree ct ON co.category_id = ct.id"
        );

        $stmt->execute([$categoryId, $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a course by category id
     * 
     * @param int $id
     * @return array|null
     */
    public static function getByCategoryId($id)
    {
        $stmt = Database::getInstance()->getConnection()->prepare(
            "WITH RECURSIVE parent_tree AS (
                SELECT id, parent_id, name
                FROM categories
                WHERE id = ?
                
                UNION ALL
                
                SELECT c.id, c.parent_id, c.name
                FROM categories c
                JOIN parent_tree pt ON c.id = pt.parent_id
            )
            SELECT co.*, 
                (SELECT name FROM parent_tree WHERE parent_id IS NULL LIMIT 1) AS main_category_name
            FROM courses co
            JOIN categories c ON co.category_id = c.id
            WHERE co.category_id = ?"
        );
        $stmt->execute([$id, $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
