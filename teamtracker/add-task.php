`<?php
require 'includes/connect.php';
require 'includes/auth.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name'] ?? '');
    $position   = trim($_POST['position'] ?? '');
    $height     = trim($_POST['height'] ?? '');
    $team_name  = trim($_POST['team_name'] ?? '');
    $stats      = trim($_POST['stats'] ?? '');

    if ($first_name === '' || $last_name === '' || $position === '' || $team_name === '') {
        $errors[] = "First name, last name, position, and team name are required.";
    } else {
        $stmt = $conn->prepare("
            INSERT INTO team_members (first_name, last_name, position, phone, email, team_name, photo)
            VALUES (:fn, :ln, :pos, :ph, :em, :team, :photo)
        ");

    
        $stmt->execute([
            ':fn'   => $first_name,
            ':ln'   => $last_name,
            ':pos'  => $position,
            ':ph'   => null,
            ':em'   => null,
            ':team' => $team_name,
            ':photo'=> null
        ]);

        header("Location: players.php");
        exit;
    }
}

require 'includes/header.php';
?>

<h2>Add Player</h2>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $e) echo "<div>$e</div>"; ?>
    </div>
<?php endif; ?>

<form method="post" style="max-width: 500px;">

    <div class="mb-3">
        <label class="form-label">Team Name</label>
        <input name="team_name" class="form-control" value="<?= htmlspecialchars($team_name ?? '') ?>">
    </div>

    <div class="mb-3">
`         <label class="form-label">First Name</label>
        <input name="first_name" class="form-control" value="<?= htmlspecialchars($first_name ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input name="last_name" class="form-control" value="<?= htmlspecialchars($last_name ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Height</label>
        <input name="height" class="form-control" placeholder="e.g., 6'2&quot;" value="<?= htmlspecialchars($height ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Position</label>
        <input name="position" class="form-control" placeholder="Pitcher, Catcher, etc." value="<?= htmlspecialchars($position ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Stats</label>
        <textarea name="stats" class="form-control"><?= htmlspecialchars($stats ?? '') ?></textarea>
    </div>

    <button class="btn btn-primary">Save Player</button>
    <a href="players.php" class="btn btn-secondary">Cancel</a>
</form>

<?php require 'includes/footer.php'; ?>
