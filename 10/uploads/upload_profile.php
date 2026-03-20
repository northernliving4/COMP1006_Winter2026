<?php
require "includes/auth.php";
require "includes/connect.php";

$user_id = $_SESSION['user_id'];

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {

    $file = $_FILES['profile_pic'];


    $allowed = ['image/jpeg', 'image/png', 'image/gif'];

    if (!in_array($file['type'], $allowed)) {
        die("Invalid file type. Only JPG, PNG, and GIF allowed.");
    }


    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = "user_" . $user_id . "_" . time() . "." . $ext;

    $uploadPath = "uploads/" . $newName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {


        $sql = "UPDATE users SET profile_pic = :pic WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':pic', $newName);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        header("Location: profile.php");
        exit;

    } else {
        die("Error moving uploaded file.");
    }

} else {
    die("No file uploaded.");
}


/*Reflection Questions 
What is the purpose of the $_FILES superglobal in PHP? 
- stores information about files uploaded through an HTML form.

Why does a form need special settings to upload files?
- A form needs special settings so the browser can send file data correctly instead of plain text.
What function is used to move uploaded files to a folder?
- The function used is move_uploaded_file().
Why is it important to control where uploaded files are stored?
- It’s important to control the storage location to keep the server secure and prevent users from uploading files into unsafe directories.

*/