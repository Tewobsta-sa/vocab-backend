<?php
require 'db.php';

header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');
session_start();

$user_id = 1; 
$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM words WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'Word deleted successfully']);
    } else {
        echo json_encode(['error' => 'Invalid word ID or unauthorized']);
    }
} else {
    echo json_encode(['error' => $stmt->error]);
}