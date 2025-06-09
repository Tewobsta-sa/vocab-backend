<?php
require 'db.php';
// Allow CORS
header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

session_start();
if (!isset($_SESSION['user_id'])) exit;

$user_id = $_SESSION['user_id'];

$word = $_POST['word'];
$def = $_POST['definition'];
$diff = $_POST['difficulty'];

$stmt = $conn->prepare("INSERT INTO words (user_id, word, definition, difficulty) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $user_id, $word, $def, $diff);
$stmt->execute();