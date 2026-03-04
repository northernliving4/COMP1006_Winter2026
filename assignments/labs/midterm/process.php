<?php
require 'connect.php';

$errors = [];


$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$author = trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);
$review_text = trim(filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


if ($title === "") $errors[] = "Title is required.";
if ($author === "") $errors[] = "Author is required.";
if ($rating === "" || !is_numeric($rating)) {
    $errors[] = "Rating must be a number.";
} else {
    if ($rating < 1 || $rating > 5) $errors[] = "Rating must be between 1 and 5.";
}
if ($review_text === "") $errors[] = "Review text is required.";

if (!empty($errors)) {
    echo "<h2>Errors:</h2><ul>";
    foreach ($errors as $e) echo "<li>$e</li>";
    echo "</ul><a href='index.php'>Go Back</a>";
    exit;
}


$sql = "INSERT INTO reviews (title, author, rating, review_text)
        VALUES (:title, :author, :rating, :review_text)";
$stmt = $db->prepare($sql);

$stmt->bindValue(':title', $title);
$stmt->bindValue(':author', $author);
$stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
$stmt->bindValue(':review_text', $review_text);

$stmt->execute();

echo "<p>Review submitted successfully!</p>";
echo "<a href='index.php'>Submit Another</a> | <a href='admin.php'>Admin Page</a>";
