<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
</head>
<body>
    <h2>Are you sure you want to delete your account?</h2>

    <form action="process-delete.php" method="POST">
        <button type="submit">Yes, delete my account</button>
    </form>

    <a href="account.php">Cancel</a>
</body>
</html>
