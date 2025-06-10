<?php
require 'db.php';
header("Access-Control-Allow-Origin: http://10.4.96.116");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

session_start();

$user_id = 1;

$data = json_decode(file_get_contents("php://input"), true);

$id   = $data['id'];
$word = $data['word'];
$def  = $data['definition'];
$diff = $data['difficulty'];

$stmt = $conn->prepare("UPDATE words SET word = ?, definition = ?, difficulty = ? WHERE id = ? AND user_id = ?");
$stmt->bind_param("sssii", $word, $def, $diff, $id, $user_id);
$stmt->execute();