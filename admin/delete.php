<?php
session_start();
require '../config/db.php';

if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        // User:
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $sql_user = "DELETE FROM users WHERE user_id = '$user_id'";
            if ($conn->query($sql_user) === TRUE) {
                header("location: ./user.php");
            }
        }
        // Major:
        if (isset($_GET['major_id'])) {
            $major_id = $_GET['major_id'];
            $sql_user = "DELETE FROM major WHERE major_id = '$major_id'";
            if ($conn->query($sql_user) === TRUE) {
                header("location: ./major.php");
            }
        }
        // Course:
        if (isset($_GET['course_id'])) {
            $course_id = $_GET['course_id'];
            $sql_user = "DELETE FROM course_major WHERE course_id = '$course_id'";
            if ($conn->query($sql_user) === TRUE) {
                header("location: ./course.php");
            }
        }
    } else {
        echo "Bạn không có quyền truy cập trang này" . "<a href='../index.php'>Về trang chủ</a>";
    }
} else {
    header("location: ../pages/login.php");
}
