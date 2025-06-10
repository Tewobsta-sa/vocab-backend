<?php
require 'db.php';
// Allow CORS
header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

session_start();
$user_id = 1;

$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'];

$stmt = $conn->prepare("INSERT INTO decks (user_id, title) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $title);
$stmt->execute();