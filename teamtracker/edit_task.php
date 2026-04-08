<?php
require 'includes/connect.php';
require 'includes/auth.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id AND user_id = :uid");
$stmt->execute([':id' => $id, ':uid' => $_SESSION['user_id']]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    header("Location: index.php");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $due_date    = $_POST['due_date'] ?? null;
    $is_done     = isset($_POST['is_done']) ? 1 : 0;

    if ($title === '') {
        $errors[] = "Title is required.";
    } else {
        $stmt = $conn->prepare("
            UPDATE tasks
            SET title = :t, description = :d, due_date = :due, is_done = :done
            WHERE id = :id AND user_id = :uid
        ");
        $stmt->execute([
            ':t'   => $title,
            ':d'   => $description,
            ':due' => $due_date ?: null,
            ':done'=> $is_done,
            ':id'  => $id,
            ':uid' => $_SESSION['user_id']
        ]);
        header("Location: index.php");
        exit;
    }
}

require 'includes/header.php';
?>

<h2>Edit Task</h2>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $e) echo "<div>$e</div>"; ?>
    </div>
<?php endif; ?>

<form method="post" style="max-width: 500px;">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" class="form-control" value="<?= htmlspecialchars($task['title']) ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"><?= htmlspecialchars($task['description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input name="due_date" type="date" class="form-control" value="<?= htmlspecialchars($task['due_date']) ?>">
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_done" id="is_done"
               <?= $task['is_done'] ? 'checked' : '' ?>>
        <label class="form-check-label" for="is_done">
            Mark as done
        </label>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php require 'includes/footer.php'; ?>
