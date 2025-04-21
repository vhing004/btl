<?php
session_start();

$course_id = $_GET['course_id'];

// Tạo session giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Nếu khóa học chưa có trong giỏ hàng thì thêm vào
if (!in_array($course_id, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $course_id;
}

// Quay lại course_detail.php với course_id
header("Location: ../pages/course_detail.php?course_id=$course_id");
exit();
