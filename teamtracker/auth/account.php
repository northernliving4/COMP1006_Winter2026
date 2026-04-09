<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT username, email, created_at FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Account</title>
</head>
<body>
    <h2>Account Details</h2>

    <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Member Since:</strong> <?= $user['created_at'] ?></p>

    <a href="delete.php">Delete Account</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
