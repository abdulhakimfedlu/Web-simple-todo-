<?php
header('Content-Type: application/json');
include 'db_connect.php';

$task = $_POST['task'] ?? '';

if (empty($task)) {
    echo json_encode(['success' => false, 'message' => 'Task cannot be empty']);
    exit();
}

try {
    $stmt = $pdo->prepare('INSERT INTO tasks (task) VALUES (?)');
    $stmt->execute([$task]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error adding task: ' . $e->getMessage()]);
}
?>