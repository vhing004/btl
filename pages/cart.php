<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <a href="../index.php" class="header_logo">
                    <h2 class="header_logo-title">Humg Education</h2>
                </a>
                <form action="./course_detail.php" class="header_search">
                    <input type="text" name="search" placeholder="Tìm kiếm khóa học" />
                    <button class="header_search-btn">Tìm kiếm</button>
                </form>
                <div class="header_menu">
                    <?php
                    // session_start();
                    if (!isset($_SESSION["user_id"])) {
                    ?>
                        <a href="./register.php" class="header_menu-btn">Đăng ký</a>
                        <a href="./login.php" class="header_menu-btn btn2">Đăng nhập</a>
                        <?php } else {
                        require '../config/db.php';
                        $sql_user = "SELECT * FROM users WHERE user_id = '" . $_SESSION["user_id"] . "'";
                        $result_user = $conn->query($sql_user);
                        if ($result_user->num_rows > 0) {
                            $row_user = $result_user->fetch_assoc();

                        ?>
                            <div class="header_menu-avatar">
                                <div class="header_menu-img">
                                    <img src="../assets/images/chill.jpg" alt="" />
                                </div>
                                <div class="dropdown">
                                    <div class="dropdown_head">
                                        <img src="../assets/images/chill.jpg" alt="" />
                                        <div class="dropdown_info">
                                            <h4 class="dropdown_name"><?php echo $row_user['fullname']; ?></h4>
                                            <span class="dropdown_username">@<?php echo $row_user['username']; ?></span>
                                        </div>
                                    </div>
                                    <div class="dropdown_inner">
                                        <?php
                                        if ($_SESSION['role'] == 'user') {
                                        ?>
                                            <a href="../index.php">Trang chủ</a>
                                            <a href="./account.php">Trang cá nhân</a>
                                            <a href="./personal.php">Cài đặt</a>
                                            <a href="../pages/cart.php">Giỏ hàng</a>

                                        <?php } else {
                                        ?>
                                            <a href="../admin/index.php">Trang quản trị</a>
                                        <?php }
                                        ?>
                                        <a href="./logout.php">Đăng xuất</a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
            </div>
        </header>
        <div class="container_cart cart-page">
            <h2 class="page-title">Giỏ hàng của bạn</h2>

            <?php if (count($cart) === 0): ?>
                <p class="empty-cart">Giỏ hàng trống. Hãy thêm khóa học vào giỏ!</p>
            <?php else: ?>
                <form id="cart-form" action="../handler/payment.php" method="POST">
                    <div class="cart-list">
                        <?php
                        $total = 0;
                        foreach ($cart as $course_id):
                            $sql = "SELECT * FROM course_major WHERE course_id = $course_id";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0):
                                $course = $result->fetch_assoc();
                                $total += $course['price'];
                        ?>
                                <div class="cart-item">


                                    <div class="cart-img">
                                        <img src="<?= htmlspecialchars($course['course_img'] ?? '../assets/default-course.jpg') ?>" alt="Ảnh khóa học">
                                    </div>

                                    <div class="cart-item-info">
                                        <h4><?= htmlspecialchars($course['course_name']) ?></h4>
                                        <p class="price">Giá: <?= number_format($course['price']) ?> VND</p>
                                        <p class="description"><?= htmlspecialchars($course['description']) ?></p>
                                    </div> <input
                                        type="checkbox"
                                        class="course-checkbox"
                                        name="selected_courses[]"
                                        value="<?= $course['course_id'] ?>"
                                        data-price="<?= $course['price'] ?>"
                                        checked>
                                </div>
                        <?php endif;
                        endforeach; ?>
                    </div>

                    <div class="cart-summary">
                        <p><strong>Tổng tiền:</strong> <span id="total-price"><?= number_format($total) ?></span> VND</p>
                        <button type="submit" class="btn-checkout">Thanh toán</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const checkboxes = document.querySelectorAll('.course-checkbox');
        const totalEl = document.getElementById('total-price');

        function formatCurrency(number) {
            return number.toLocaleString('vi-VN');
        }

        function updateTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseInt(cb.getAttribute('data-price'));
                }
            });
            totalEl.textContent = formatCurrency(total);
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
    </script>
</body>

</html>