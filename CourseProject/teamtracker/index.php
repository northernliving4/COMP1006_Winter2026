<?php
require('connect.php');

// Fetch all team members
$query = "SELECT * FROM team_members ORDER BY id DESC";
$statement = $conn->prepare($query);
$statement->execute();
$members = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Team Tracker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h1 class="mb-4 text-center">Team Tracker</h1>

    <?php if (isset($_GET['message']) && $_GET['message'] === 'created'): ?>
        <div class="alert alert-success">Team member added successfully!</div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="create.php" class="btn btn-primary">Add New Member</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Team</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($members as $member): ?>
                <tr>
                    <td><?= $member['id'] ?></td>
                    <td><?= $member['first_name'] . ' ' . $member['last_name'] ?></td>
                    <td><?= $member['position'] ?></td>
                    <td><?= $member['phone'] ?></td>
                    <td><?= $member['email'] ?></td>
                    <td><?= $member['team_name'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $member['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $member['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this member?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</div>

</body>
</html>
