<?php
require 'includes/connect.php';
require 'includes/auth.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $due_date    = $_POST['due_date'] ?? null;

    if ($title === '') {
        $errors[] = "Title is required.";
    } else {
        $stmt = $conn->prepare("
            INSERT INTO tasks (user_id, title, description, due_date)
            VALUES (:uid, :t, :d, :due)
        ");
        $stmt->execute([
            ':uid' => $_SESSION['user_id'],
            ':t'   => $title,
            ':d'   => $description,
            ':due' => $due_date ?: null
        ]);
        header("Location: index.php");
        exit;
    }
}

require 'includes/header.php';
?>

<h2>Add Task</h2>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $e) echo "<div>$e</div>"; ?>
    </div>
<?php endif; ?>

<form method="post" style="max-width: 500px;">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" class="form-control" value="<?= htmlspecialchars($title ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"><?= htmlspecialchars($description ?? '') ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input name="due_date" type="date" class="form-control" value="<?= htmlspecialchars($due_date ?? '') ?>">
    </div>
    <button class="btn btn-primary">Save</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php require 'includes/footer.php'; ?>
