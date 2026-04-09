<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$userId]);

session_destroy();

header("Location: register.php");
exit;
?>
