<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "<h2 style='margin-top: 80px; text-align: center;'><a href='login.php'>Bạn chưa đăng nhập</a></h2>";
}

if (isset($_POST['submit'])) {
    require '../config/db.php';

    $user_id = $_SESSION['user_id'];

    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    $sql_update = "UPDATE users SET username='$username', fullname='$fullname', email='$email', gender='$gender', password='$password' WHERE user_id='$user_id'";

    if ($conn->query($sql_update) === TRUE) {
        header("location: ../pages/personal.php");
    } else {
        echo "Lỗi: " . $sql_update . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="../assets/css/app.css">
</head>

<body>
    <div class="dashboard">
        <?php
        if ($_SESSION['role'] == 'user') {
        ?>
            <main class="main">
                <form action="" class="form update" method="post">
                    <h2 class="title">Thông tin tài khoản</h2>
                    <?php
                    require '../config/db.php';

                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT * FROM users WHERE user_id = $user_id";
                    $result = $conn->query($sql);

                    if ($result) {
                        $user = $result->fetch_assoc();
                    } else {
                        exit();
                    }

                    ?>
                    <div class="form_group none">
                        <input hidden type="text" value="<?php echo $user['user_id']; ?>" name="user_id">
                    </div>
                    <div class="form_group">
                        <label>Tên người dùng</label>
                        <input type="text" name="username" value="<?php echo $user['username']; ?>" require>
                    </div>
                    <div class="form_group">
                        <label>Email</label>
                        <input type="text" name="email" value="<?php echo $user['email']; ?>" require>
                    </div>
                    <div class="form_group">
                        <label>Tên đầy đủ</label>
                        <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" require>
                    </div>
                    <div class="form_group">
                        <label>Giới tính</label>
                        <input type="text" name="gender" value="<?php echo $user['gender']; ?>" require>
                    </div>

                    <div class="form_group">
                        <label>Mật khẩu</label>
                        <input type="text" name="password" value="<?php echo $user['password']; ?>">
                    </div>
                    <div class="btn__group">
                        <input class="btn auto" type="submit" name="submit" value="Cập nhật">
                        <a class="btn auto" href="../pages/personal.php">Hủy thay đổi</a>
                    </div>
                </form>
            </main>
        <?php }
        ?>
    </div>
</body>

</html>