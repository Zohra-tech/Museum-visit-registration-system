<?php
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: view.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit('Invalid registration ID.');
}

$stmt = $pdo->prepare("DELETE FROM registrations WHERE id = ?");
$stmt->execute([$id]);

if ($stmt->rowCount() === 0) {
    exit('Registration not found or already deleted.');
}

header('Location: view.php?deleted=1');
exit;
?>
