<?php
require 'config.php';
require 'auth_check.php';

$id = (int)($_POST['id'] ?? 0);

$images = loadImages();
$newImages = [];

foreach ($images as $img) {
    if ($img['id'] == $id) {
        if (file_exists($img['file_path'])) {
            unlink($img['file_path']);
        }
    } else {
        $newImages[] = $img;
    }
}

saveImages($newImages);

header("Location: gallery.php");
exit;
