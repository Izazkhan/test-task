<?php

require_once 'Database.php';

class Category
{

    /**
     * Get all categories
     * 
     * @return array
     */
    public static function getAll()
    {
        $query = "WITH RECURSIVE category_tree AS (
                SELECT id, parent_id, id AS root_id, name
                FROM categories
                UNION
                SELECT c.id, c.parent_id AS parent_id, ct.root_id, c.name
                FROM categories c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT 
                c.id AS category_id,
                c.name AS category_name,
                c.parent_id AS parent_id,
                (SELECT COUNT(*) FROM courses co WHERE co.category_id IN (
                    SELECT id FROM category_tree WHERE root_id = c.id
                )) AS count_of_courses
            FROM categories c
            ORDER BY c.name
        ";
        $stmt = Database::getInstance()->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all categories ids
     * 
     * @return array
     */
    public static function getCategoriesIds()
    {
        $query = "SELECT c.id AS category_id
                FROM categories c
                WHERE c.parent_id IS NULL
        ";
        $stmt = Database::getInstance()->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a category by ID
     * 
     * @param int $id
     * @return array|null
     */
    public static function find($id)
    {
        $query = "WITH RECURSIVE category_tree AS (
                SELECT id, parent_id, id AS root_id, name
                FROM categories
                WHERE id = ?
                UNION
                SELECT c.id, c.parent_id AS parent_id, ct.root_id, c.name
                FROM categories c
                JOIN category_tree ct ON c.parent_id = ct.id
            )
            SELECT 
                c.id AS category_id,
                c.name AS category_name,
                c.parent_id,
                (SELECT COUNT(*) FROM courses co WHERE co.category_id IN (
                    SELECT id FROM category_tree WHERE root_id = c.id
                )) AS count_of_courses
            FROM category_tree c
            WHERE c.id = ?
            ORDER BY c.name
        ";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([$id, $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
