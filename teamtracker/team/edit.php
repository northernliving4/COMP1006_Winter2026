<?php
require('connect.php');

// Turn on error reporting during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("Error: No ID provided.");
}

$id = $_GET['id'];

// Fetch the existing record
$query = "SELECT * FROM team_members WHERE id = :id";
$statement = $conn->prepare($query);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();
$member = $statement->fetch();

if (!$member) {
    die("Error: Member not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Team Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4 text-center">Edit Team Member</h2>

    <form action="process-edit.php" method="POST" class="needs-validation" novalidate>

        <input type="hidden" name="id" value="<?= $member['id'] ?>">

        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?= $member['first_name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?= $member['last_name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="text" name="position" class="form-control" value="<?= $member['position'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= $member['phone'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $member['email'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Team Name</label>
            <input type="text" name="team_name" class="form-control" value="<?= $member['team_name'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Save Changes</button>

    </form>
</div>

</body>
</html>
