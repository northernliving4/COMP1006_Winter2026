<?php
require 'connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) die("Invalid ID");

$sql = "DELETE FROM reviews WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header("Location: admin.php");
exit;
