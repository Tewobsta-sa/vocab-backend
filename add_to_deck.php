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

$deck_id = $data['deck_id'];
$word_id = $data['word_id'];

// Make sure this deck belongs to this user
$result = $conn->query("SELECT id FROM decks WHERE id = $deck_id AND user_id = " . $user_id );
if ($result->num_rows === 0) exit;

// Avoid duplicates
$conn->query("INSERT IGNORE INTO deck_words (deck_id, word_id) VALUES ($deck_id, $word_id)");

if ($conn->affected_rows > 0) {
    echo json_encode(["status" => "success", "message" => "Word added to deck"]);
} else {
    echo json_encode(["status" => "ignored", "message" => "Word already exists in deck or nothing was inserted"]);
}
