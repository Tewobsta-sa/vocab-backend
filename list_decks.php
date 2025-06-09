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
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT id, title FROM decks WHERE user_id = $user_id");
$decks = [];

while ($row = $result->fetch_assoc()) {
    $decks[] = $row;
}
echo json_encode($decks);