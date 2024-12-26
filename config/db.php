<?php
$localhost = 'localhost';
$username = 'root';
$password = '';
$dbname = 'a2';

$conn = new mysqli($localhost, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
