<?php
require 'connect.php';

$sql = "SELECT * FROM reviews ORDER BY created_at DESC";
$stmt = $db->query($sql);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Admin</title></head>
<body>

<h1>All Book Reviews</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Title</th><th>Author</th>
        <th>Rating</th><th>Review</th><th>Created</th><th>Actions</th>
    </tr>

    <?php foreach ($reviews as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['id']) ?></td>
            <td><?= htmlspecialchars($r['title']) ?></td>
            <td><?= htmlspecialchars($r['author']) ?></td>
            <td><?= htmlspecialchars($r['rating']) ?></td>
            <td><?= nl2br(htmlspecialchars($r['review_text'])) ?></td>
            <td><?= htmlspecialchars($r['created_at']) ?></td>
            <td>
                <a href="edit.php?id=<?= $r['id'] ?>">Update</a> |
                <a href="delete.php?id=<?= $r['id'] ?>"
                   onclick="return confirm('Delete this review?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<p><a href="index.php">Back to Form</a></p>

</body>
</html>
