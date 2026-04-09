<?php
// Show all errors
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require 'config/connect.php';
require 'includes/header.php';


?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Add Baseball Player</h2>
    <a href="players_list.php" class="btn btn-primary">View Players</a>
</div>

<form action="process_add_player.php" method="POST" class="card p-4">

    <div class="mb-3">
        <label class="form-label">Team Name</label>
        <input type="text" name="team_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Player First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Player Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Height</label>
        <input type="text" name="height" class="form-control" placeholder="e.g., 6'2&quot;" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Position</label>
        <input type="text" name="position" class="form-control" placeholder="Pitcher, Catcher, etc." required>
    </div>

    <div class="mb-3">
        <label class="form-label">Stats</label>
        <textarea name="stats" class="form-control" rows="3" placeholder="Optional: batting avg, ERA, etc."></textarea>
    </div>

    <button type="submit" class="btn btn-success">Save Player</button>
</form>

<?php require 'includes/footer.php'; ?>
