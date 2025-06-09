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


$deck_id = $_POST['deck_id'];
$word_id = $_POST['word_id'];

// Make sure this deck belongs to this user
$result = $conn->query("SELECT id FROM decks WHERE id = $deck_id AND user_id = " . $_SESSION['user_id']);
if ($result->num_rows === 0) exit;

// Avoid duplicates
$conn->query("INSERT IGNORE INTO deck_words (deck_id, word_id) VALUES ($deck_id, $word_id)");