<?php
header('Content-Type: application/json');
include 'db_connect.php';

$id = $_POST['id'] ?? 0;
$completed = $_POST['completed'] ?? 0;

try {
    $stmt = $pdo->prepare('UPDATE tasks SET completed = ? WHERE id = ?');
    $stmt->execute([$completed, $id]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error updating task: ' . $e->getMessage()]);
}
?>