<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require __DIR__ . '/../config/database.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM issues WHERE id = ?");
$stmt->execute([$id]);
$issue = $stmt->fetch();

if (!$issue) {
    die('Issue not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = $_POST['status'] ?? 'open';

    if ($title === '' || $description === '') {
        $error = 'All fields are required.';
    } else {
        $stmt = $pdo->prepare("
            UPDATE issues
            SET title = ?, description = ?, status = ?
            WHERE id = ?
        ");
        $stmt->execute([$title, $description, $status, $id]);

        header('Location: ../dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Issue</title>
</head>
<body>

<h1>Edit Issue</h1>

<p><a href="../dashboard.php">← Back</a></p>

<form method="post">
    <label>Title</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($issue['title']); ?>" required><br><br>

    <label>Description</label><br>
    <textarea name="description" rows="6" cols="50" required><?php echo htmlspecialchars($issue['description']); ?></textarea><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="open" <?php if ($issue['status'] === 'open') echo 'selected'; ?>>Open</option>
        <option value="in_progress" <?php if ($issue['status'] === 'in_progress') echo 'selected'; ?>>In Progress</option>
        <option value="closed" <?php if ($issue['status'] === 'closed') echo 'selected'; ?>>Closed</option>
    </select><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>
