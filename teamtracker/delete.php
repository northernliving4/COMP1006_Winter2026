<?php
require('connect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['id'])) {
    die("Error: No ID provided.");
}

$id = $_GET['id'];

$query = "DELETE FROM team_members WHERE id = :id";
$statement = $conn->prepare($query);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

header("Location: index.php?message=deleted");
exit;
?>
