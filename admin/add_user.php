<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="app.css">
</head>

<body>
    <div class="wrapper">
        <?php
        session_start();
        require '../config/db.php';
        if (isset($_SESSION['username'])) {
            if ($_SESSION['role'] == 'admin') {
        ?>
                <form action="" class="form" method="post">
                    <h3 class="title">Thêm dữ liệu USER</h3>
                    <div class="form_group">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Username" require>
                    </div>
                    <div class="form_group">
                        <label>Password </label>
                        <input type="text" name="password " placeholder="Username" require>
                    </div>
                    <div class="form_group">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Email" require>
                    </div>
                    <div class="form_group">
                        <label>Fullname</label>
                        <input type="text" name="fullname" placeholder="Fullname" require>
                    </div>
                    <div class="form_group" style="display: flex; gap: 10px;">
                        <label>Gender</label>
                        <select name="gender">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Thêm">
                </form>
        <?php }
        }
        ?>
    </div>
</body>

</html>

<!-- USER -->
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];

    $sql_update_user = "INSERT INTO users (username,password, email, fullname, gender) VALUES ('$username', ' $password', '$email', '$fullname', '$gender')";

    if ($conn->query($sql_update_user) === TRUE) {
        header("location: ./user.php");
    } else {
        echo "Lỗi: " . $sql_update_user . "<br>" . $conn->error;
    }
    $conn->close();
}
?>