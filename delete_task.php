<?php
header('Content-Type: application/json');
include 'db_connect.php';

$id = $_POST['id'] ?? 0;

try {
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
    $stmt->execute([$id]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error deleting task: ' . $e->getMessage()]);
}
?>
