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


        <main class="main">
            <div class="course">
                <div class="container">
                    <?php
                    require '../config/db.php';
                    $major_id = $_GET['major_id'];
                    $sql = "SELECT * FROM major WHERE major_id=$major_id";
                    $row = ($conn->query($sql))->fetch_assoc();
                    ?>
                    <div class="major_banner">
                        <div class="major_banner-img">
                            <img src="<?php echo $row['major_img']; ?>" alt="" />
                        </div>
                        <div class="major_banner-inner" style="background-image: url(<?php echo $row['major_img'] ?>)">
                            <h5 class="major_banner-title"><?php echo $row['name'] ?></h5>
                            <p class="major_banner-desc"><?php echo $row['description'] ?></p>
                            <span class="major_banner-code">Mã: <?php echo $row['major_code'] ?></span>
                        </div>
                    </div>
                    <div class="major2_list">
                        <?php
                        $sql_course = "SELECT * FROM course_major WHERE major_id = " . $row['major_id'];
                        $result_course = $conn->query($sql_course);
                        if ($result_course->num_rows > 0) {
                            while ($row2 = $result_course->fetch_assoc()) {
                        ?>
                                <a href="./course_detail.php?course_id=<?php echo $row2['course_id']; ?>" class="major2_item">
                                    <div class="major2_img">
                                        <img src="<?php echo $row2['course_img']; ?>" alt="" />
                                    </div>
                                    <div class="major2_content">
                                        <h3 class="major2_content-title">
                                            <?php echo $row2['course_name']; ?>
                                        </h3>
                                        <p class="major2_content-desc">
                                            <?php echo $row2['description']; ?>
                                        </p>
                                        <div class="major2_content-end">
                                            <div class="major2_content-rating">
                                                <span class="video"><?php echo $row2['video']; ?> Videos</span>
                                                <span class="star"><b><?php echo $row2['rating']; ?></b><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> <i class="fa-solid fa-star-half-stroke"></i></span>
                                            </div>
                                            <span class="major2_content-price"><?php echo $row2['price']; ?> VND</span>
                                        </div>
                                    </div>
                                </a>
                        <?php  }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>