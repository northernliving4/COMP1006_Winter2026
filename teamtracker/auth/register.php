<?php
//require 'config/connect.php';
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if ($username === '' || $email === '' || $password === '' || $confirm === '') {
        $errors[] = "All fields are required.";
    } elseif ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email OR username = :username");
        $stmt->execute([':email' => $email, ':username' => $username]);
        if ($stmt->fetch()) {
            $errors[] = "Username or email already in use.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:u, :e, :p)");
            $stmt->execute([':u' => $username, ':e' => $email, ':p' => $hash]);
            header("Location: login.php");
            exit;
        }
    }
}
//require 'includes/header.php';
?>

<h2>Register</h2>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $e) echo "<div>$e</div>"; ?>
    </div>
<?php endif; ?>

<form method="post" class="mt-3" style="max-width: 400px;">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" class="form-control" value="<?= htmlspecialchars($username ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($email ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="password" type="password" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input name="confirm_password" type="password" class="form-control">
    </div>
    <button class="btn btn-primary">Register</button>
    <a href="login.php" class="btn btn-link">Already have an account?</a>
</form>

<?php //require 'includes/footer.php'; ?>
