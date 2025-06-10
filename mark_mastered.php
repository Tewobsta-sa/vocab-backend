<?php
require 'db.php';
// Allow CORS
header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$deck_id = $data['deck_id'];
$word_id = $data['word_id'];

$conn->query("DELETE FROM deck_words WHERE deck_id = $deck_id AND word_id = $word_id");