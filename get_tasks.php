<?php
header('Content-Type: application/json');
include 'db_connect.php';

try {
    $stmt = $pdo->query('SELECT * FROM tasks ORDER BY id DESC');
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tasks);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error fetching tasks: ' . $e->getMessage()]);
}
?>