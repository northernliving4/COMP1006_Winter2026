<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: register.php");
        exit;
    }

    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Username or email already exists.";
        header("Location: register.php");
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashedPassword]);

    $_SESSION['success'] = "Registration successful. Please log in.";
    header("Location: login.php");
    exit;
}
?>
