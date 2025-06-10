<?php

require 'db.php';
header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
$user_id = $_SESSION['user_id'];
$words = $conn->query("SELECT COUNT(*) AS total FROM words WHERE user_id = $user_id")->fetch_assoc();

// Get total decks
$decks = $conn->query("SELECT COUNT(*) AS total FROM decks WHERE user_id = $user_id")->fetch_assoc();

// Get quiz results
$quizData = $conn->query("
  SELECT COUNT(*) AS total_quizzes, 
         IFNULL(AVG(score), 0) AS avg_score 
  FROM quiz_results 
  WHERE user_id = $user_id
")->fetch_assoc();

echo json_encode([
  'total_words' => (int)$words['total'],
  'total_decks' => (int)$decks['total'],
  'total_quizzes' => (int)$quizData['total_quizzes'],
  'average_score' => round($quizData['avg_score'], 2)
]);