<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$user_id = $_SESSION['user_id'];
$difficulty = $_GET['difficulty'];

$conn = new mysqli("localhost", "root", "", "vocab_app");

// Select 10 random words of this difficulty
$result = $conn->query("
    SELECT id, word, definition 
    FROM words 
    WHERE user_id = $user_id AND difficulty = '$difficulty' 
    ORDER BY RAND() 
    LIMIT 10
");

$questions = [];

while ($row = $result->fetch_assoc()) {
    $word = $row['word'];
    $def = $row['definition'];

    // Get 3 fake definitions
    $fakeRes = $conn->query("
        SELECT definition 
        FROM words 
        WHERE user_id = $user_id AND definition != '" . $conn->real_escape_string($def) . "' 
        ORDER BY RAND() 
        LIMIT 3
    ");

    $fakeDefs = [];
    while ($fake = $fakeRes->fetch_assoc()) {
        $fakeDefs[] = $fake['definition'];
    }

    $questions[] = [
        'word' => $word,
        'definition' => $def,
        'fake1' => $fakeDefs[0] ?? 'N/A',
        'fake2' => $fakeDefs[1] ?? 'N/A',
        'fake3' => $fakeDefs[2] ?? 'N/A'
    ];
}

echo json_encode($questions);