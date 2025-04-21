<?php
session_start();
require '../config/db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <a href="../index.php" class="header_logo">
                    <h2 class="header_logo-title">Humg Education</h2>
                </a>
                <form class="header_search">
                    <input type="text" name="search" placeholder="Tìm kiếm khóa học" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" />
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


        <main class="main">
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $sql3 = "SELECT * FROM course_major WHERE course_name LIKE '%$search%'";
            } elseif (isset($_GET['course_id'])) {
                $course_id = $_GET['course_id'];
                $sql3 = "SELECT * FROM course_major WHERE course_id = $course_id";
            }
            $result = $conn->query($sql3);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="courseDetail">
                        <!-- banner -->
                        <div class="courseDetail_banner">
                            <div class="courseDetail_banner-inner">
                                <h3 class="courseDetail_banner-title">
                                    <?php echo $row['course_name']; ?>
                                </h3>
                                <p class="courseDetail_banner-desc">
                                    <?php echo $row['description']; ?>

                                </p>
                                <div class="courseDetail_banner-info">
                                    <span><b> <?php echo $row['rating']; ?> <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></b>(999 đánh giá)</span>
                                    <span>15.999 học viên</span>
                                </div>
                                <span class="courseDetail_banner-teacher">Giảng viên: <b> <?php echo $row['teacher_name']; ?>
                                    </b></span>
                            </div>
                        </div>
                        <!-- intro -->
                        <div class="courseDetail_intro">
                            <div class="container">
                                <div class="courseDetail_intro-inner">
                                    <h4 class="courseDetail_intro-title">Bạn sẽ học được</h4>
                                    <div class="courseDetail_intro-list">
                                        <div class="courseDetail_intro-item">
                                            <i class="fa-solid fa-check"></i>
                                            <span>Thành thạo kỹ năng ghép và chỉnh sửa ảnh bằng
                                                Photoshop</span>
                                        </div>
                                        <div class="courseDetail_intro-item">
                                            <i class="fa-solid fa-check"></i>
                                            <span>Thành thạo kỹ năng ghép và chỉnh sửa ảnh bằng
                                                Photoshop</span>
                                        </div>
                                        <div class="courseDetail_intro-item">
                                            <i class="fa-solid fa-check"></i>
                                            <span>Thành thạo kỹ năng ghép và chỉnh sửa ảnh bằng
                                                Photoshop</span>
                                        </div>
                                        <div class="courseDetail_intro-item">
                                            <i class="fa-solid fa-check"></i>
                                            <span>Thành thạo kỹ năng ghép và chỉnh sửa ảnh bằng
                                                Photoshop</span>
                                        </div>
                                        <div class="courseDetail_intro-item">
                                            <i class="fa-solid fa-check"></i>
                                            <span>Thành thạo kỹ năng ghép và chỉnh sửa ảnh bằng
                                                Photoshop</span>
                                        </div>
                                        <div class="courseDetail_intro-item">
                                            <i class="fa-solid fa-check"></i>
                                            <span>Thành thạo kỹ năng ghép và chỉnh sửa ảnh bằng
                                                Photoshop</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- course -->
                        <div class="courseDetail_course">
                            <div class="courseDetail_course-img">
                                <img src="  <?php echo $row['course_img']; ?>" alt="" />
                                <span class="play">
                                    <i class="fa-regular fa-circle-play"></i></span>
                            </div>
                            <div class="courseDetail_course-content">
                                <p class="courseDetail_course-price"> <?php echo $row['price']; ?> VND</p>
                                <?php
                                if (isset($_SESSION['username'])) {

                                    if ($_SESSION['role'] == 'user') {
                                ?>
                                        <!-- <a
                                            href="../handler/dangky.php?course_id=<?php echo $row['course_id']; ?>"
                                            class="courseDetail_course-btn">Đăng ký ngay</a> -->
                                        <div class="courseDetail_course-btns">
                                            <div class="courseDetail_cart"> <a class="cart" href="../handler/add_to_cart.php?course_id=<?php echo $row['course_id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping"></i></a><span class="pane">Thêm vào giỏ hàng</span></div>

                                            <a href="../handler/payment.php?course_id=<?php echo $row['course_id']; ?>" class="courseDetail_course-btn">Mua ngay</a>
                                        </div>

                                    <?php } else {
                                    ?>
                                        <a
                                            href=""
                                            class="courseDetail_course-btn">Bạn là ADMIN</a>
                                    <?php }
                                } else {
                                    ?>
                                    <a
                                        href="./login.php"
                                        class="courseDetail_course-btn">Đăng ký ngay</a>
                                <?php }
                                ?>
                                <div class="courseDetail_course-intro">
                                    <div class="courseDetail_course-item">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Thời lượng: <b> <?php echo $row['video']; ?> Videos</b></span>
                                    </div>
                                    <div class="courseDetail_course-item">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Giáo trình: <b> <?php echo $row['video']; ?> bài giảng</b></span>
                                    </div>
                                    <div class="courseDetail_course-item">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Thời lượng: <b>07 giờ 55 phút</b></span>
                                    </div>
                                    <div class="courseDetail_course-item">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Thời lượng: <b>07 giờ 55 phút</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
                echo "<main style='text-align: center; padding-top: 50px'>Không có khóa học nào</main>";
            }
            ?>
        </main>
        <button id="scrollToTop" class="scroll-top-btn"><i class="fa-solid fa-chevron-up"></i></button>

    </div>
</body>
<script
    type="text/javascript"
    src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script
    type="text/javascript"
    src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="./js/app.js"></script>

</html>