<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_courses'])) {
    $selected_courses = array_map('intval', $_POST['selected_courses']);

    if (empty($selected_courses)) {
        echo "<div class='container'><p class='empty-cart'>Bạn chưa chọn khóa học nào để thanh toán.</p></div>";
        exit();
    }

    $course_ids_str = implode(",", $selected_courses);
    $sql = "SELECT * FROM course_major WHERE course_id IN ($course_ids_str)";
    $result = $conn->query($sql);

    $courses = [];
    $total_price = 0;

    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
        $total_price += $row['price'];
    }

    if (isset($_POST['confirm_payment'])) {
        foreach ($selected_courses as $course_id) {
            $check_sql = "SELECT * FROM user_courses WHERE user_id=$user_id AND course_id=$course_id";
            $check_result = $conn->query($check_sql);
            if ($check_result->num_rows === 0) {
                $conn->query("INSERT INTO user_courses (user_id, course_id) VALUES ($user_id, $course_id)");
            }
        }

        // Cập nhật giỏ hàng
        $_SESSION['cart'] = array_diff($_SESSION['cart'], $selected_courses);
        header("Location: ../pages/account.php");
        exit();
    }
} else {
    echo "<div class='container'><p class='empty-cart'>Không có khóa học nào được chọn để thanh toán.</p></div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác nhận thanh toán</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div class="container_cart payment-page">
        <h2 class="page-title">Xác nhận thanh toán</h2>

        <?php foreach ($courses as $course): ?>
            <div class="course-item">
                <div class="cart-img">
                    <img src="<?= htmlspecialchars($course['course_img'] ?? '../assets/default-course.jpg') ?>" alt="Ảnh khóa học">
                </div>
                <div class="cart-item-info">
                    <h4><?= htmlspecialchars($course['course_name']) ?></h4>
                    <p class="price">Giá: <?= number_format($course['price']) ?> VND</p>
                    <p class="description"><?= htmlspecialchars($course['description']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>

        <h3 class="total-price">Tổng tiền: <?= number_format($total_price) ?> VND</h3>

        <form method="POST">
            <?php foreach ($selected_courses as $id): ?>
                <input type="hidden" name="selected_courses[]" value="<?= $id ?>">
            <?php endforeach; ?>
            <button type="submit" name="confirm_payment" class="btn-checkout">Xác nhận thanh toán</button>
        </form>
    </div>
</body>

</html>