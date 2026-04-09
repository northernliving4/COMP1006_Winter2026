<?php
//require 'config/connect.php';
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $errors[] = "Email and password are required.";
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}

//require 'includes/header.php';
?>

<h2>Login</h2>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $e) echo "<div>$e</div>"; ?>
    </div>
<?php endif; ?>

<form method="post" class="mt-3" style="max-width: 400px;">
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($email ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="password" type="password" class="form-control">
    </div>
    <button class="btn btn-primary">Login</button>
    <a href="register.php" class="btn btn-link">Create an account</a>
</form>

<?php //require 'includes/footer.php'; ?>
