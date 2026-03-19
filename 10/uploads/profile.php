<?php
require "includes/auth.php";
require "includes/connect.php";
require "includes/header.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT username, email, profile_pic FROM users WHERE id = :id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<main class="container mt-4">
    <h2>Your Profile</h2>

    <div class="mb-4">
        <h4>Current Profile Picture</h4>

        <?php if (!empty($user['profile_pic'])): ?>
            <img src="uploads/<?= htmlspecialchars($user['profile_pic']) ?>" 
                 alt="Profile Picture" 
                 class="img-thumbnail" 
                 width="200">
        <?php else: ?>
            <p>No profile picture uploaded yet.</p>
        <?php endif; ?>
    </div>

    <h4>Upload New Profile Picture</h4>

    <form action="upload_profile.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="profile_pic" class="form-control mb-3" required>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</main>

<?php require "includes/footer.php"; ?>
