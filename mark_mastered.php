<?php
session_start();
if (!isset($_SESSION['user_id'])) exit;

$deck_id = $_POST['deck_id'];
$word_id = $_POST['word_id'];
$conn = new mysqli("localhost", "root", "", "vocab_app");

$conn->query("DELETE FROM deck_words WHERE deck_id = $deck_id AND word_id = $word_id");