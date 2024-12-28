<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="app.css">
</head>

<body>
    <?php
    session_start();
    require '../config/db.php';
    if ($_SESSION['role'] == 'admin') {
    ?>
        <header class="header">
            <div class="header_inner">
                <ul class="header_list">
                    <li class="header_item"><a href="index.php" class="header_link">Trang chủ</a></li>
                    <li class="header_item"><a href="user.php" class="header_link active">Quản lý User</a></li>
                    <li class="header_item"><a href="major.php" class="header_link">Chuyên ngành</a></li>
                    <li class="header_item"><a href="course.php" class="header_link">Khóa học</a></li>
                    <li class="header_item"><a href="user_course.php" class="header_link">Người dùng đky khóa học</a></li>
                </ul>
                <a href="../pages/logout.php">Đăng xuất</a>
            </div>
        </header>


        <div class="container">

            <!-- USERS -->
            <h3>Bảng USER</h3>
            <form class="index" action="">
                <input type="text" name="search_user" placeholder="Tìm kiếm">
                <button type="submit">Search</button>
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password </th>
                    <th>Email</th>
                    <th>Fullname</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Created_at</th>
                    <th>Chức năng</th>
                </tr>
                <?php
                if (isset($_GET['search_user'])) {
                    $search_user = $_GET['search_user'];
                    $sql_user = "SELECT * FROM users WHERE username LIKE '%$search_user%'";
                } else {
                    $sql_user =  "SELECT * FROM users";
                }
                $result_user = $conn->query($sql_user);
                if ($result_user->num_rows > 0) {
                    while ($row_user = $result_user->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row_user['user_id']; ?></td>
                            <td><?php echo $row_user['username']; ?></td>
                            <td><?php echo $row_user['password']; ?></td>
                            <td><?php echo $row_user['email']; ?></td>
                            <td><?php echo $row_user['fullname']; ?></td>
                            <td><?php echo $row_user['gender']; ?></td>
                            <td><?php echo $row_user['role']; ?></td>
                            <td><?php echo $row_user['created_at']; ?></td>
                            <td><a href="update.php?user_id=<?php echo $row_user['user_id']; ?>">Sửa</a> | <a href="delete.php?user_id=<?php echo $row_user['user_id']; ?>">Xóa</a></td>
                        </tr>
                <?php }
                }
                ?>
            </table>
            <a class="btn" href="./add_user.php">Thêm người dùng</a>


        </div>
    <?php }
    ?>
</body>

</html>