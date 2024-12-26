<?php
session_start();
require '../config/db.php';

$course_id = $_GET['course_id'];
$sql = "SELECT * FROM course_major WHERE course_id = $course_id";
$result = $conn->query($sql);
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
                <div class="header_search">
                    <input type="text" placeholder="Tìm kiếm chuyên ngành" />
                    <button class="header_search-btn">Tìm kiếm</button>
                </div>
                <div class="header_menu">
                    <?php
                    // session_start();
                    if (!isset($_SESSION["user_id"])) {
                    ?>
                        <a href="./pages/register.php" class="header_menu-btn">Đăng ký</a>
                        <a href="./pages/login.php" class="header_menu-btn btn2">Đăng nhập</a>
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
                                            <a href="./account.php">Trang cá nhân</a>
                                            <a href="./personal.php">Cài đặt</a>
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


        <div class="account">
            <div class="account_banner">
                <img class="account_banner-img" src="../assets/images/banner.png" alt="">
                <div class="account_info">
                    <img src="../assets/images/chill.jpg" alt="">
                    <?php
                    require '../config/db.php';
                    // 
                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                    } else {
                        $user_id = $_SESSION['user_id'];
                    }
                    // 
                    // $user_id = &$_SESSION['user_id'];
                    $sql = "SELECT * FROM users WHERE user_id =$user_id";
                    $row = ($conn->query($sql))->fetch_assoc();
                    ?>
                    <h3 class="account_info-name"><?php echo $row['fullname']; ?></h3>
                    <?php ?>
                </div>
            </div>

            <div class="account_inner">
                <!-- intro -->
                <div class="account_intro">
                    <div class="account_intro-item">
                        <span class="account_intro-title">Giới thiệu</span>
                        <p class="account_intro-desc"><i class="fa-solid fa-user-group"></i><span>Thành viên của <b>HUMG Education - Học để đi làm</b> từ một năm trước</span></p>
                    </div>
                    <div class="account_intro-item">
                        <span class="account_intro-title">Hoạt động gần đây</span>
                        <p class="account_intro-desc">Chưa có hoạt động gần đây</p>
                    </div>
                </div>
                <!-- COurse -->
                <div class="account_course">
                    <span class="account_course-title">Các khóa học đã đăng ký</span>
                    <?php

                    $sql_course = "SELECT course_major.* FROM course_major 
                        INNER JOIN user_courses ON course_major.course_id = user_courses.course_id 
                        WHERE user_courses.user_id=$user_id";
                    $result_course = $conn->query($sql_course);
                    if ($result_course->num_rows > 0) {
                        while ($row_course = $result_course->fetch_assoc()) {
                    ?>
                            <div class="account_course-item">
                                <img src="<?php echo $row_course['course_img'] ?>" alt="">
                                <div class="account_course-content">
                                    <h4 class="account_course-name"><?php echo $row_course['course_name'] ?></h4>
                                    <p class="account_course-desc"><?php echo $row_course['description'] ?></p>
                                    <div class="account_course-btn">
                                        <a href="./course_detail.php?course_id=<?php echo $row_course['course_id']; ?>">Xem khóa học</a>
                                        <?php
                                        if ($_SESSION['role'] == 'user') {
                                        ?>
                                            <a href="../handler/unreg.php?course_id=<?php echo $row_course['course_id']; ?>">Hủy </a>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else {
                        echo " <main class='main' style='margin-bottom: 15px;'>Bạn chưa đăng ký khóa học nào !</main>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <footer class="footer"></footer>
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