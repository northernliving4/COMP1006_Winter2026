<?php
require 'includes/connect.php';
require 'includes/auth.php';
require 'includes/header.php';

$stmt = $conn->prepare("SELECT username, email, created_at FROM users WHERE id = :id");
$stmt->execute([':id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h2>Your Profile</h2>

<?php if ($user): ?>
    <ul class="list-group" style="max-width: 400px;">
        <li class="list-group-item"><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></li>
        <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
        <li class="list-group-item"><strong>Member since:</strong> <?= htmlspecialchars($user['created_at']) ?></li>
    </ul>
<?php else: ?>
    <div class="alert alert-danger mt-3">User not found.</div>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>
