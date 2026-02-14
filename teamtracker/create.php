<?php
// include database connection
require('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Team Member</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

<div class="container">
    <h2 class="mb-4 text-center">Add Team Member</h2>

    <form action="process-create.php" method="POST" class="needs-validation" novalidate>

        <!-- First Name -->
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
            <div class="invalid-feedback">Please enter a first name.</div>
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
            <div class="invalid-feedback">Please enter a last name.</div>
        </div>

        <!-- Position -->
        <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="text" name="position" class="form-control" required>
            <div class="invalid-feedback">Please enter a position.</div>
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" required>
            <div class="invalid-feedback">Please enter a phone number.</div>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required>
            <div class="invalid-feedback">Please enter a valid email.</div>
        </div>

        <!-- Team Name -->
        <div class="mb-3">
            <label class="form-label">Team Name</label>
            <input type="text" name="team_name" class="form-control" required>
            <div class="invalid-feedback">Please enter a team name.</div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Add Member</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Client-side validation script -->
<script>
(() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>

</body>
</html>
