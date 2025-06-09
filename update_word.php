<?php
session_start();
if (!isset($_SESSION['user_id'])) exit;

$conn = new mysqli("localhost", "root", "", "vocab");

$id = $_POST['id'];
$word = $_POST['word'];
$def = $_POST['definition'];
$diff = $_POST['difficulty'];

$stmt = $conn->prepare("UPDATE words SET word = ?, definition = ?, difficulty = ? WHERE id = ? AND user_id = ?");
$stmt->bind_param("sssii", $word, $def, $diff, $id, $_SESSION['user_id']);
$stmt->execute();