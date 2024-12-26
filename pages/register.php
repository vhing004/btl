<?php
$message_username = "";
$message_password = "";

if (isset($_GET['submit'])) {
    require '../config/db.php';

    $username = $_GET['username'];
    $fullname = $_GET['fullname'];
    $email = $_GET['email'];
    $gender = $_GET['gender'];
    $password = $_GET['password'];
    $confirm = $_GET['confirm'];

    $sql_user = "SELECT * FROM users";
    $result = $conn->query($sql_user);
    // while ($user = $result->fetch_assoc()) {
    // }
    $user = $result->fetch_assoc();
    if ($username == $user['username']) {
        $message_username = "Tài khoản đã tồn tại";
    }
    if ($password !== $confirm) {
        $message_password = 'Không trùng mật khẩu';
    } else {
        $sql_register = "INSERT INTO users (username, password, gender, email, fullname) VALUES ('$username', '$password', '$gender' , '$email' , '$fullname' )";
        if ($conn->query($sql_register)) {
            header("location: login.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/app.css">
</head>

<body>
    <div class="wrapper">
        <form action="" method="get" class="form">
            <h2 class="title">Đăng ký tài khoản</h2>
            <?php if (!empty($message_username)) : ?>
                <div class="error"><?php echo $message_username; ?></div>
            <?php endif; ?>
            <div class="form_group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form_group">
                <label>Email</label>
                <input type="text" name="email" required>
            </div>
            <div class="form_group">
                <label>Tên đầy đủ</label>
                <input type="text" name="fullname" required>
            </div>
            <div class="form_group" style="display: flex; gap: 10px;">
                <label>Giới tính</label>
                <select name="gender">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="form_group">
                <label>Password</label>
                <input type="text" name="password" required>
            </div>
            <?php if (!empty($message_password)) : ?>
                <div class="error"><?php echo $message_password; ?></div>
            <?php endif; ?>
            <div class="form_group">
                <label>Xác nhận mật khẩu</label>
                <input type="text" name="confirm" required>
            </div>
            <div class="submit">
                <input class="btn" type="submit" name="submit" value="Đăng ký">
                <a href="./login.php">Bạn đã có tài khoản</a>
            </div>
        </form>
    </div>
</body>

</html>