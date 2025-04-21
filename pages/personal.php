<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "<h2 style='margin-top: 80px; text-align: center;'><a href='login.php'>Bạn chưa đăng nhập</a></h2>";
}
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
    <link rel="stylesheet" href="../assets/css/app.css" />
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
                                            <a href="">Cài đặt</a>
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

        <?php
        if (isset($_SESSION['username'])) {
            if ($_SESSION['role'] == 'user') {
                require '../config/db.php';
                $id = $_SESSION['user_id'];
                $sql_edit = "SELECT * FROM users WHERE user_id=$id";
                $result = $conn->query($sql_edit);
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

        ?>
                    <main class="main account">
                        <div class="main_table">
                            <h2 class="title">Thông tin tài khoản</h2>
                            <div class="table_group">
                                <p>Id: <span><?php echo $user['user_id']; ?></span></p>
                            </div>
                            <div class="table_group">
                                <p>Tên: <span><?php echo $user['username']; ?></span></p>
                            </div>
                            <div class="table_group">
                                <p>Email: <span><?php echo $user['email']; ?></span></p>
                            </div>
                            <div class="table_group">
                                <p>Giới tính: <span><?php echo $user['gender']; ?></span></p>
                            </div>
                            <div class="table_group">
                                <p>Mật khẩu: <span><?php echo $user['password']; ?></span></p>
                            </div>
                            <div class="table_group end">
                                <p>Ngày tạo: <span><?php echo $user['created_at']; ?></span></p>
                            </div>
                            <button class="table_btn"><a href="../handler/account_edit.php">Sửa thông tin</a></button>
                        </div>
                    </main>
        <?php }
            } else {
                echo "<main class='main' >Bạn không có quyền truy cập trang này <a href='../admin/index.php'>Về trang ADMIN</a></main>";
            }
        } else {
            header("location: ./login.php");
        }
        ?>
    </div>

</body>

</html>