<?php
//challenge students to create independently initially */ 
require "includes/connect.php";
require "includes/header.php";

// Get all products, newest first
//set up the query 
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$stmt = $pdo ->prepare($sql);
//execute
$stmt->execute();
//use fetchAll to return 
$products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<main class="container mt-4">
    <h1 class="mb-4">Our Products</h1>

</main>

<?php require "includes/footer.php"; ?>