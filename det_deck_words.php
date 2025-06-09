<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$deck_id = $_GET['deck_id'];
$conn = new mysqli("localhost", "root", "", "vocab_app");

$sql = "SELECT w.id, w.word, w.definition 
        FROM deck_words dw 
        JOIN words w ON dw.word_id = w.id 
        JOIN decks d ON d.id = dw.deck_id 
        WHERE dw.deck_id = $deck_id AND d.user_id = " . $_SESSION['user_id'];

$result = $conn->query($sql);
$cards = [];

while ($row = $result->fetch_assoc()) {
    $cards[] = $row;
}
echo json_encode($cards);