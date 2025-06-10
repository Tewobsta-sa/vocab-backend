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


$user_id = 1;

$result = $conn->query("SELECT id, title FROM decks WHERE user_id = $user_id");
$decks = [];

while ($row = $result->fetch_assoc()) {
    $decks[] = $row;
}

echo json_encode($decks);