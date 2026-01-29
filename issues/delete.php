<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require __DIR__ . '/../config/database.php';

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM issues WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: ../dashboard.php');
exit;
