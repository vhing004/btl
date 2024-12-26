<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'];

// Kiểm tra xem đã đăng ký chưa
$query = "SELECT * FROM user_courses WHERE user_id=$user_id AND course_id=$course_id";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    $query = "INSERT INTO user_courses (user_id, course_id) VALUES ($user_id, $course_id)";
    $conn->query($query);
    echo "Đăng ký thành công!";
} else {
    echo "Bạn đã đăng ký khóa học này!";
}
header("Location: ../pages/account.php");
