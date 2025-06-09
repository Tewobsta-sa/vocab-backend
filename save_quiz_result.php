<?php
session_start();
if (!isset($_SESSION['user_id'])) exit;

$user_id = $_SESSION['user_id'];
$score = $_POST['score'];
$total = $_POST['total'];

$conn = new mysqli("localhost", "root", "", "vocab_app");

$stmt = $conn->prepare("INSERT INTO quiz_results (user_id, score, total_questions) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $user_id, $score, $total);
$stmt->execute();