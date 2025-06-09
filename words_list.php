<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) exit;

$user_id = $_SESSION['user_id'];
$conn = new mysqli("localhost", "root", "", "vocab_app");

$result = $conn->query("SELECT * FROM words WHERE user_id = $user_id");
$words = [];

while ($row = $result->fetch_assoc()) {
    $words[] = $row;
}

echo json_encode($words);