<?php
$message_username = "";
$message_password = "";

if (isset($_GET['submit'])) {
    require '../config/db.php';

    $username = $_GET['username'];
    $password = $_GET['password'];

    $sql_login = "SELECT * FROM users WHERE username = '$username'";
    $result_login = $conn->query($sql_login);

    if ($result_login->num_rows > 0) {
        $user = $result_login->fetch_assoc();

        if ($user['password'] !== $password) {
            $message_password = "Sai mật khẩu!";
        } else {
            header("location: ../index.php");
            echo 'sdasd';
        }

        if ($user['role'] == 'user') {
            header("location: ../index.php");
        } else {
            header("location: ../admin/index.php");
        }

        // Lưu tên đăng nhập
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['user_id'];
    } else {
        $message_username = "Sai tên đăng nhập!";
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
    <style>
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    if (!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['user_id'])) {
    ?>
        <div class="login">
            <main class="main">
                <form action="" class="form" method="get">
                    <h2 class="title">Login</h2>
                    <?php if (!empty($message_username)) : ?>
                        <div class="error"><?php echo $message_username; ?></div>
                    <?php endif; ?>
                    <div class="form_group">
                        <label>Username</label>
                        <input type="text" name="username" required>
                    </div>
                    <?php if (!empty($message_password)) : ?>
                        <div class="error"><?php echo $message_password; ?></div>
                    <?php endif; ?>
                    <div class="form_group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="submit">
                        <input class="btn" type="submit" name="submit" value="Login">
                        <a href="./register.php">Bạn chưa có tài khoản</a>
                    </div>
                </form>
            </main>
        </div>
    <?php }
    ?>
</body>

</html>