<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require __DIR__ . '/config/database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header('Location: dashboard.php');
        exit;
    } else {
        $message = 'Invalid username or password';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login - Issue Tracker</title>
</head>
<body>
  <h1>Login</h1>

  <?php if ($message): ?>
    <p style="color:red;"><?php echo htmlspecialchars($message); ?></p>
  <?php endif; ?>

  <form method="post" action="">
    <label>
      Username<br>
      <input type="text" name="username" required>
    </label>
    <br><br>
    <label>
      Password<br>
      <input type="password" name="password" required>
  <button type="submit">Login</button>
</form>
