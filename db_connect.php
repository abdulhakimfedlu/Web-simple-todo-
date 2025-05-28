<?php
$host = 'localhost';
$db = 'todo_db';
$user = 'root'; // Default XAMPP MySQL user
$pass = ''; // Default XAMPP MySQL password (empty)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit();
}
?>