<?php

require 'db.php';
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$user_id = $_SESSION['user_id'];

// Get total words
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