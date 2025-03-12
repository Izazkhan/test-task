<?php
function getDBConnection()
{
    $host = 'db'; // Docker service name (change if needed)
    $db = 'course_catalog'; // Database name
    $user = 'test_user'; // Database username
    $pass = 'test_password'; // Database password
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        die(json_encode(["error" => "Database connection failed: " . $e->getMessage()]));
    }
}
