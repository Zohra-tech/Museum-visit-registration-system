<?php
$host = "localhost";
$port = 3306;
$dbname = "museum_db";
$username = "root";
$password = "YOUR_NEW_MYSQL_PASSWORD";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (PDOException $e) {
    exit("Database error: " . $e->getMessage());
}
?>
