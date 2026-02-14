<?php
require('connect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check required fields
if (
    isset($_POST['id'], $_POST['first_name'], $_POST['last_name'], $_POST['position'],
          $_POST['phone'], $_POST['email'], $_POST['team_name'])
) {
    $id         = $_POST['id'];
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $position   = trim($_POST['position']);
    $phone      = trim($_POST['phone']);
    $email      = trim($_POST['email']);
    $team_name  = trim($_POST['team_name']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Update query
    $query = "UPDATE team_members
              SET first_name = :first_name,
                  last_name = :last_name,
                  position = :position,
                  phone = :phone,
                  email = :email,
                  team_name = :team_name
              WHERE id = :id";

    $statement = $conn->prepare($query);

    $statement->bindParam(':id', $id);
    $statement->bindParam(':first_name', $first_name);
    $statement->bindParam(':last_name', $last_name);
    $statement->bindParam(':position', $position);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':team_name', $team_name);

    $statement->execute();

    header("Location: index.php?message=updated");
    exit;

} else {
    die("Error: Missing required fields.");
}
?>
