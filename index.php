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
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <a href="./index.php" class="header_logo">
                    <h2 class="header_logo-title">Humg Education</h2>
                </a>
                <form action="./pages/course_detail.php" class="header_search">
                    <input type="text" name="search" placeholder="Tìm kiếm chuyên ngành" />
                    <button class="header_search-btn">Tìm kiếm</button>
                </form>
                <div class="header_menu">
                    <?php
                    session_start();
                    if (!isset($_SESSION["user_id"])) {
                    ?>
                        <a href="./pages/register.php" class="header_menu-btn">Đăng ký</a>
                        <a href="./pages/login.php" class="header_menu-btn btn2">Đăng nhập</a>
                        <?php } else {
                        require './config/db.php';
                        $sql_user = "SELECT * FROM users WHERE user_id = '" . $_SESSION["user_id"] . "'";
                        $result_user = $conn->query($sql_user);
                        if ($result_user->num_rows > 0) {
                            $row_user = $result_user->fetch_assoc();

                        ?>
                            <div class="header_menu-avatar">
                                <div class="header_menu-img">
                                    <img src="./assets/images/chill.jpg" alt="" />
                                </div>
                                <div class="dropdown">
                                    <div class="dropdown_head">
                                        <img src="./assets/images/chill.jpg" alt="" />
                                        <div class="dropdown_info">
                                            <h4 class="dropdown_name"><?php echo $row_user['fullname']; ?></h4>
                                            <span class="dropdown_username">@<?php echo $row_user['username']; ?></span>
                                        </div>
                                    </div>
                                    <div class="dropdown_inner">
                                        <?php
                                        if ($_SESSION['role'] == 'user') {
                                        ?>
                                            <a href="./pages/account.php">Trang cá nhân</a>
                                            <a href="">Cài đặt</a>
                                        <?php } else {
                                        ?>
                                        <a href="./admin/index.php">Trang quản trị</a>
                                        <?php }
                                        ?>
                                        <a href="./pages/logout.php">Đăng xuất</a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
            </div>
        </header>

        <!-- main -->
        <main class="main">
            <div class="container">
                <!-- BANNER -->
                <section class="banner">
                    <div class="banner_img">
                        <img src="./assets/images/slide1.jpg" alt="" />
                    </div>
                    <div class="banner_img">
                        <img src="./assets/images/slide2.jpeg" alt="" />
                    </div>
                    <div class="banner_img">
                        <img src="./assets/images/slide3.jpeg" alt="" />
                    </div>
                    <div class="banner_img">
                        <img src="./assets/images/slide4.jpg" alt="" />
                    </div>
                </section>

                <!-- major -->
                <section class="major">
                    <div class="container">
                        <h3 class="major_title">Chuyên ngành</h3>
                        <div class="major_list">
                            <?php
                            require './config./db.php';

                            $sql_major = "SELECT * FROM major";
                            $result_major = $conn->query($sql_major);
                            if ($result_major->num_rows > 0) {
                                while ($row_major = $result_major->fetch_assoc()) {
                            ?>
                                    <a href="./pages/major.php?major_id=<?php echo $row_major['major_id']; ?>" class="major_item">
                                        <div class="major_img">
                                            <img src="<?php echo $row_major['major_img']; ?>" alt="">
                                        </div>
                                        <div class="major_content">
                                            <h4 class="major_name"><?php echo $row_major['name']; ?></h4>
                                            <p class="major_desc"> <?php echo $row_major['description']; ?></p>
                                            <span class="major_code">Mã: <?php echo $row_major['major_code']; ?></span>
                                        </div>
                                    </a>
                            <?php }
                            }
                            ?>
                        </div>
                    </div>
                </section>

                <!-- COURSE -->
                <?php
                require './config/db.php';
                $sql_major = "SELECT * FROM major";
                $result_major = $conn->query($sql_major);
                if ($result_major->num_rows > 0) {
                    while ($row = $result_major->fetch_assoc()) {
                ?>
                        <section class="course">
                            <h2 class="course_title"><?php echo $row['name'] ?></h2>
                            <div class="course_list">
                                <?php
                                $sql_course = "SELECT * FROM course_major WHERE major_id = " . $row['major_id'];
                                $result_course = $conn->query($sql_course);
                                if ($result_course->num_rows > 0) {
                                    while ($row2 = $result_course->fetch_assoc()) {
                                ?>
                                        <a href="./pages/course_detail.php?course_id=<?php echo $row2['course_id']; ?>" class="course_item">
                                            <div class="course_img">
                                                <img src="<?php echo $row2['course_img']; ?>" alt="" />
                                            </div>
                                            <div class="course_content">
                                                <h3 class="course_content-title">
                                                    <?php echo $row2['course_name']; ?>
                                                </h3>
                                                <p class="course_content-desc">
                                                    <?php echo $row2['description']; ?>
                                                </p>
                                                <div class="course_content-end">
                                                    <div class="course_content-rating">
                                                        <span class="video"><?php echo $row2['video']; ?> Videos</span>
                                                        <span class="star"><b><?php echo $row2['rating']; ?></b><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> <i class="fa-solid fa-star-half-stroke"></i></span>
                                                    </div>
                                                    <span class="course_content-price"><?php echo $row2['price']; ?> VND</span>
                                                </div>
                                            </div>
                                        </a>
                                <?php  }
                                }
                                ?>
                            </div>
                        </section>
                <?php }
                }
                ?>
            </div>
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