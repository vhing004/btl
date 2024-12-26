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
                <a href="./index.php" class="header_logo">
                    <h2 class="header_logo-title">Humg Education</h2>
                </a>
                <div class="header_search">
                    <input type="text" placeholder="Tìm kiếm chuyên ngành" />
                    <button class="header_search-btn">Tìm kiếm</button>
                </div>
                <div class="header_menu">
                    <a href="./pages/register.php" class="header_menu-btn">Đăng ký</a>
                    <a href="./pages/login.php" class="header_menu-btn btn2">Đăng nhập</a>
                    <a href="./pages/account.php" class="header_menu-avatar">
                        <img src="./assets/images/woman.avif" alt="" />
                    </a>
                </div>
            </div>
        </header>


        <main class="main">

            <?php
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
                                <a
                                    href="../handler/dangky.php?<?php echo $row['course_id']; ?>"
                                    class="courseDetail_course-btn">Đăng ký ngay</a>
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
            }
            ?>
        </main>
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