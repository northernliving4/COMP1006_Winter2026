<?php
require 'includes/connect.php';
require 'includes/auth.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :uid");
    $stmt->execute([':id' => $id, ':uid' => $_SESSION['user_id']]);
}

header("Location: index.php");
exit;
