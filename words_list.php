<?php
require 'db.php';

header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

session_start();
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM words WHERE user_id = $user_id");

$words = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $words[] = $row;
    }
    echo json_encode($words);
} else {
    echo json_encode(["error" => "Query failed"]);
}
?>