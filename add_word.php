<?php
require 'db.php';
// Allow CORS
header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

session_start();
$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

$word = $data['word'];
$def = $data['definition'];
$diff = $data['difficulty'];

$stmt = $conn->prepare("INSERT INTO words (user_id, word, definition, difficulty) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $user_id, $word, $def, $diff);
$stmt->execute();