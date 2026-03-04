<?php

$host = 'localhost';
$dbname = 'reviews';
$dsn = 'mysql:host=localhost;dbname=reviews;charset=utf8mb4';
$username = 'root';
$password = ""; 

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
