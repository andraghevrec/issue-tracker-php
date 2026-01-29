<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require __DIR__ . '/../config/database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '' || $description === '') {
        $message = 'Title and description are required.';
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO issues (title, description, status, user_id)
            VALUES (?, ?, 'open', ?)
        ");
        $stmt->execute([$title, $description, (int)$_SESSION['user_id']]);

        header('Location: ../dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Issue | Issue Tracker</title>
</head>
<body>

<h1>Create Issue</h1>

<p><a href="../dashboard.php">← Back to Dashboard</a></p>

<?php if ($message): ?>
    <p style="color:red;"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<form method="post" action="">
    <label>Title</label><br>
    <input type="text" name="title" maxlength="100" required><br><br>

    <label>Description</label><br>
    <textarea name="description" rows="6" cols="50" required></textarea><br><br>

    <button type="submit">Create</button>
</form>

</body>
</html>
