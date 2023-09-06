<?php
$host = "localhost:3306";
$username = "chat_user";
$password = "Rayan_1996";
$database = "rayan89_demo_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
