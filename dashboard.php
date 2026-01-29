<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require __DIR__ . '/config/database.php';

$stmt = $pdo->query("
    SELECT i.id, i.title, i.status, i.created_at, u.username
    FROM issues i
    JOIN users u ON u.id = i.user_id
    ORDER BY i.created_at DESC
");
$issues = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Issue Tracker</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h1>Dashboard</h1>

<p>
    Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
</p>

<p>
    <a href="issues/create.php">Create Issue</a> |
    <a href="logout.php">Logout</a>
</p>

<h2>Latest Issues</h2>

<?php if (empty($issues)): ?>
    <p>No issues yet.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Author</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($issues as $issue): ?>
            <tr>
                <td><?php echo (int)$issue['id']; ?></td>
                <td><?php echo htmlspecialchars($issue['title']); ?></td>

                <td class="status-<?php echo htmlspecialchars($issue['status']); ?>">
                    <?php echo htmlspecialchars($issue['status']); ?>
                </td>

                <td><?php echo htmlspecialchars($issue['username']); ?></td>
                <td><?php echo htmlspecialchars($issue['created_at']); ?></td>
                <td>
                    <a href="issues/edit.php?id=<?php echo (int)$issue['id']; ?>">Edit</a> |
                    <a href="issues/delete.php?id=<?php echo (int)$issue['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this issue?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
