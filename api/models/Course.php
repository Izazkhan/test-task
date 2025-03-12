<?php

require_once 'Database.php';

class Course
{
    public function __construct() {}

    // Static Method to Find Course by ID
    public static function find($id)
    {
        $stmt = Database::getInstance()->getConnection()->prepare("
            SELECT * FROM courses WHERE id = :id
        ");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null; // Return null if no course is found
    }

    public static function all()
    {
        $stmt = Database::getInstance()->getConnection()->query("SELECT * FROM courses");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // add method which get course by category_id
    public static function getByCategory($id)
    {
        $stmt = Database::getInstance()->getConnection()->prepare("
            SELECT * FROM courses WHERE category_id = :id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
