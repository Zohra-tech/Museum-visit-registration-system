<?php
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

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
    $name === '' ||
    strlen($name) > 100 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($email) > 150 ||
    $number === false ||
    $number < 1 ||
    $number > 100 ||
    !$validDate ||
    $validDate->format('Y-m-d') !== $date ||
    $date < date('Y-m-d') ||
    !$validTime ||
    $validTime->format('H:i') !== $time
) {
    exit('Invalid registration details. Please go back and check your entries.');
}

try {
    $sql = "INSERT INTO registrations
            (visitor_name, email, number_of_visitors, visit_date, visit_time)
            VALUES (:name, :email, :number, :date, :time)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':number' => $number,
        ':date' => $date,
        ':time' => $time
    ]);

    header('Location: view.php?success=1');
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit('Registration could not be saved. Please try again.');
}
?>
