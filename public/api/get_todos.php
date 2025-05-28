<?php
require_once '../db.php';

header('Content-Type: application/json');

function getTodos() {
    $db = connectDB();
    $query = "SELECT id, task FROM todos";
    $result = $db->query($query);

    $todos = [];
    while ($row = $result->fetch_assoc()) {
        $todos[] = [
            'id' => $row['id'],
            'task' => $row['task']
        ];
    }

    $db->close();
    return $todos;
}

echo json_encode(getTodos());
?>