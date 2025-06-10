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
header('Content-Type: application/json');



$user_id = 1;


// Total words
$words = $conn->query("SELECT COUNT(*) FROM words WHERE user_id = $user_id")->fetch_row()[0];

// Total quizzes
$quizzes = $conn->query("SELECT COUNT(*) FROM quizzes WHERE user_id = $user_id")->fetch_row()[0];

// Total flashcards (deck_words entries)
$flashcards = $conn->query("SELECT COUNT(*) FROM deck_words dw JOIN decks d ON dw.deck_id = d.id WHERE d.user_id = $user_id")->fetch_row()[0];

// Average score
$avg = $conn->query("SELECT AVG(score) FROM quizzes WHERE user_id = $user_id")->fetch_row()[0];
$avg_score = $avg ? round($avg) : 0;

echo json_encode([
    "words" => $words,
    "quizzes" => $quizzes,
    "flashcards" => $flashcards,
    "avg_score" => $avg_score
]);

$conn->close();
?>