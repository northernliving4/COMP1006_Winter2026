<?php
require 'config.php';

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? "");
    $email = trim($_POST['email'] ?? "");
    $password = $_POST['password'] ?? "";

    if ($username === "" || $email === "" || $password === "") {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    $admins = loadAdmins();

    foreach ($admins as $a) {
        if ($a['email'] === $email) {
            $errors[] = "Email already registered.";
        }
    }

    if (empty($errors)) {
        $admins[] = [
            "id" => count($admins) + 1,
            "username" => $username,
            "email" => $email,
            "password_hash" => password_hash($password, PASSWORD_DEFAULT)
        ];

        saveAdmins($admins);
        $success = "Registration successful. You may now log in.";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h1>Register</h1>

<?php foreach ($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

<form method="post">
    Username: <input name="username"><br>
    Email: <input name="email"><br>
    Password: <input type="password" name="password"><br>
    <button>Register</button>
</form>

<a href="login.php">Login</a>
</body>
</html>
