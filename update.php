<?php
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: view.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$name = trim($_POST['visitor_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$number = filter_var(
    $_POST['number_of_visitors'] ?? null,
    FILTER_VALIDATE_INT
);
$date = $_POST['visit_date'] ?? '';
$time = $_POST['visit_time'] ?? '';

$validDate = DateTime::createFromFormat('!Y-m-d', $date);
$validTime = DateTime::createFromFormat('!H:i', $time);

if (
    !$id || $id < 1 ||
    $name === '' || strlen($name) > 100 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($email) > 150 ||
    $number === false || $number < 1 || $number > 100 ||
    !$validDate || $validDate->format('Y-m-d') !== $date ||
    $date < date('Y-m-d') ||
    !$validTime || $validTime->format('H:i') !== $time
) {
    exit('Invalid details. Please go back and check your entries.');
}

$stmt = $pdo->prepare(
    "UPDATE registrations
     SET visitor_name = ?, email = ?, number_of_visitors = ?,
         visit_date = ?, visit_time = ?
     WHERE id = ?"
);

$stmt->execute([$name, $email, $number, $date, $time, $id]);

if ($stmt->rowCount() === 0) {
    $check = $pdo->prepare("SELECT id FROM registrations WHERE id = ?");
    $check->execute([$id]);

    if (!$check->fetch()) {
        exit('Registration not found.');
    }
}

header('Location: view.php?updated=1');
exit;
?>
