<?php
// Include database connection
require('connect.php');

// --- SERVER-SIDE ---

// Check if all required fields exist
if (
    isset($_POST['first_name'], $_POST['last_name'], $_POST['position'],
          $_POST['phone'], $_POST['email'], $_POST['team_name'])
) {
    // Trim input to remove extra spaces
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $position   = trim($_POST['position']);
    $phone      = trim($_POST['phone']);
    $email      = trim($_POST['email']);
    $team_name  = trim($_POST['team_name']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // OPTIONAL: Basic phone validation 
    if (!preg_match('/^[0-9\-\(\) ]+$/', $phone)) {
        die("Invalid phone number.");
    }

    // --- INSERT INTO ---
    $query = "INSERT INTO team_members 
              (first_name, last_name, position, phone, email, team_name)
              VALUES (:first_name, :last_name, :position, :phone, :email, :team_name)";

    $statement = $conn->prepare($query);

    // Bind parameters
    $statement->bindParam(':first_name', $first_name);
    $statement->bindParam(':last_name', $last_name);
    $statement->bindParam(':position', $position);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':team_name', $team_name);

    // Execute insert
    $statement->execute();

    // Redirect back to index with success message
    header("Location: index.php?message=created");
    exit;

} else {
    // Missing fields
    die("Error: Required form fields are missing.");
}
?>
