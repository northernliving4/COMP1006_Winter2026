<?php
// Set the reporting level to show everything (including notices and deprecations)error_reporting(E_ALL);
// Force the errors to be displayed in the browserini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
require 'config/connect.php';
require 'includes/header.php';

$stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = :uid ORDER BY created_at DESC");
//$stmt->execute([':uid' => $_SESSION['user_id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Your Tasks</h2>
    <a href="add_task.php" class="btn btn-success">Add Task</a>
</div>

<?php if (!$tasks): ?>
    <div class="alert alert-info">You have no tasks yet.</div>
<?php else: ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Due</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['due_date']) ?></td>
                <td><?= $task['is_done'] ? 'Done' : 'Pending' ?></td>
                <td>
                    <a href="edit_task.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="delete_task.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Delete this task?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>
