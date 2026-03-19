<?php if (!empty($_SESSION['user_id'])): ?>

    <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
    </li>

<?php else: ?>

    <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
    </li>

<?php endif; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>COMP1006 - Lab 1</title>
</head>
<body>
  <h1>COMP1006 - Lab 1</h1>
  <p>Week 2: PHP OOP + Includes + PDO Connection</p>
  <hr>
