<?php
require 'config.php';
require 'auth_check.php';

$images = loadImages();
?>
<!DOCTYPE html>
<html>
<body>
<h1>Gallery</h1>

<p>Logged in as: <?= htmlspecialchars($_SESSION['username']) ?></p>
<a href="upload.php">Upload New</a> | <a href="logout.php">Logout</a>

<?php if (empty($images)): ?>
    <p>No images yet.</p>
<?php else: ?>
    <?php foreach ($images as $img): ?>
        <div style="margin-bottom:20px;">
            <h3><?= htmlspecialchars($img['title']) ?></h3>
            <img src="<?= $img['file_path'] ?>" style="max-width:200px;"><br>

            <form method="post" action="delete.php">
                <input type="hidden" name="id" value="<?= $img['id'] ?>">
                <button>Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
