<?php
require_once '../db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id']) && isset($data['task'])) {
        $id = $data['id'];
        $task = $data['task'];

        $conn = connectDB(); // Use the same function as in get_todos.php
        $stmt = $conn->prepare("UPDATE todos SET task = ? WHERE id = ?");
        $stmt->bind_param("si", $task, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'To-Do item updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update To-Do item.']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>