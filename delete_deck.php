<?php
session_start();
if (!isset($_SESSION['user_id'])) exit;

$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "vocab_app");

$conn->query("DELETE FROM deck_words WHERE deck_id = $id");
$conn->query("DELETE FROM decks WHERE id = $id AND user_id = " . $_SESSION['user_id']);