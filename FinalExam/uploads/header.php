<?php
// header.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery App</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        nav a { margin-right: 15px; }
    </style>
</head>
<body>

<nav>
    <?php if (isset($_SESSION['admin_id'])): ?>
        Logged in as: <?= htmlspecialchars($_SESSION['username']) ?> |
        <a href="gallery.php">Gallery</a>
        <a href="upload.php">Upload</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>

<hr>
