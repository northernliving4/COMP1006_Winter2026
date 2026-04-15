<?php
require 'config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? "");
    $password = $_POST['password'] ?? "";

    if ($email === "" || $password === "") {
        $errors[] = "Email and password required.";
    }

    $admins = loadAdmins();

    foreach ($admins as $admin) {
        if ($admin['email'] === $email && password_verify($password, $admin['password_hash'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];
            header("Location: gallery.php");
            exit;
        }
    }

    $errors[] = "Invalid login.";
}
?>
<!DOCTYPE html>
<html>
<body>
<h1>Login</h1>

<?php foreach ($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>

<form method="post">
    Email: <input name="email"><br>
    Password: <input type="password" name="password"><br>
    <button>Login</button>
</form>

<a href="register.php">Register</a>
</body>
</html>
