<?php
require 'db.php';
// Allow CORS
header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$title = $_POST['title'];
$user_id = $_SESSION['user_id'];


$stmt = $conn->prepare("INSERT INTO decks (user_id, title) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $title);
$stmt->execute();
echo 'success';
echo json_encode(["status" => "success", "deck_id" => $stmt->insert_id]);