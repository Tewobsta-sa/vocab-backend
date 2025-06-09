<?php
session_start();
if (!isset($_SESSION['user_id'])) exit;

$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "vocab_app");

$stmt = $conn->prepare("DELETE FROM words WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();