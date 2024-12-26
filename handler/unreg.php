<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<h2 style='margin-top: 80px; text-align: center;'><a href='login.php'>Bạn chưa đăng nhập</a></h2>";
}

require '../config/db.php';
$course_id = $_GET['course_id'];

$sql_un = "DELETE FROM user_courses WHERE course_id = '$course_id'";
if ($conn->query($sql_un) === TRUE) {
    header("location: ../pages/account.php");
} else {
    echo $conn->error;
}
