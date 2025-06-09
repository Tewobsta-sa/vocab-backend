<?php 
$host = "localhost";
$dbname = "vocab";
$user = "root";
$pass = "";

// Connect to DB
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}