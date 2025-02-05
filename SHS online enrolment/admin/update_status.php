<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$form_id = $data['form_id'] ?? '';
$status = $data['status'] ?? '';

if (!$form_id || !$status) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit();
}

$query = "UPDATE student_forms SET status = ? WHERE form_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "si", $status, $form_id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
