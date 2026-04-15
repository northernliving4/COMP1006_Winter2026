<?php
require 'config.php';
require 'auth_check.php';

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? "");

    if ($title === "") {
        $errors[] = "Title required.";
    }

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Image upload failed.";
    }

    if (empty($errors)) {
        $tmp = $_FILES['image']['tmp_name'];
        $type = mime_content_type($tmp);

        $allowed = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        if (!in_array($type, $allowed)) {
            $errors[] = "Only image files allowed.";
        }

        if (empty($errors)) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $newName = uniqid("img_", true) . "." . $ext;

            move_uploaded_file($tmp, "uploads/" . $newName);

            $images = loadImages();
            $images[] = [
                "id" => count($images) + 1,
                "title" => $title,
                "file_path" => "uploads/" . $newName
            ];
            saveImages($images);

            $success = "Image uploaded!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h1>Upload Image</h1>

<p>Logged in as: <?= htmlspecialchars($_SESSION['username']) ?></p>
<a href="gallery.php">Back to Gallery</a> | <a href="logout.php">Logout</a>

<?php foreach ($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

<form method="post" enctype="multipart/form-data">
    Title: <input name="title"><br>
    Image: <input type="file" name="image"><br>
    <button>Upload</button>
</form>
</body>
</html>
