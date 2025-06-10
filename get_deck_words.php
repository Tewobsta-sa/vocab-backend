<?php
require 'db.php'; // Ensure this file connects to your database

// Allow CORS
header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

session_start();
$user_id = 1; // Set to the actual user_id from the session or other source

// Get the input data
$data = json_decode(file_get_contents("php://input"), true);
$deck_id = isset($data['deck_id']) ? intval($data['deck_id']) : 0; // Validate input

if ($deck_id <= 0) {
    die(json_encode(["error" => "Invalid deck ID."]));
}

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT w.id, w.word, w.definition 
                         FROM deck_words dw 
                         JOIN words w ON dw.word_id = w.id 
                         JOIN decks d ON d.id = dw.deck_id 
                         WHERE dw.deck_id = ? AND d.user_id = ?");
$stmt->bind_param("ii", $deck_id, $user_id);

if (!$stmt->execute()) {
    die(json_encode(["error" => "Query execution failed: " . $stmt->error]));
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die(json_encode(["error" => "No flashcards found for this deck."]));
}

$cards = [];
while ($row = $result->fetch_assoc()) {
    $cards[] = $row; // Add each card to the array
}

$stmt->close();
$conn->close();

echo json_encode($cards); // Return the JSON response
?>