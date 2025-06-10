<?php
require 'db.php';
// Allow CORS
header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

session_start();
$user_id = $_SESSION['user_id'];
if (!isset($_GET['id'])) {
  echo json_encode(['error' => 'Missing deck ID']);
  exit;
}
$id = (int)$_GET['id'];

$conn->query("DELETE FROM deck_words WHERE deck_id = $id");
$conn->query("DELETE FROM decks WHERE id = $id AND user_id = " . $user_id);