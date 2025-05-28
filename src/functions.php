<?php
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function formatResponse($status, $message, $data = null) {
    return json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
}

function validateTodoInput($input) {
    if (empty($input['title'])) {
        return formatResponse('error', 'Title is required.');
    }
    return formatResponse('success', 'Valid input.');
}
?>