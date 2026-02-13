<?php
$host = "localhost";
$dbname = "form";
$username = "root";
$password = ""; // empty password

try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Connection error: " . $e->getMessage();
    exit;
}
