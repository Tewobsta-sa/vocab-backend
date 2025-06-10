<?php
session_start();
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

echo json_encode([
  "session_id" => session_id(),
  "user_id" => $_SESSION["user_id"] ?? "not set"
]);
