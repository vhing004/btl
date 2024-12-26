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
                    <li class="header_item"><a href="user.php" class="header_link">Quản lý User</a></li>
                    <li class="header_item"><a href="major.php" class="header_link active">Chuyên ngành</a></li>
                    <li class="header_item"><a href="course.php" class="header_link">Khóa học</a></li>
                    <li class="header_item"><a href="user_course.php" class="header_link">Người dùng đky khóa học</a></li>
                </ul>
                <a href="../pages/logout.php">Đăng xuất</a>
            </div>
        </header>


        <div class="container">
            <!-- MAJOR -->
            <h3>Bảng MAJOR</h3>
            <form class="index" action="">
                <input type="text" name="search_major" placeholder="Tìm kiếm">
                <button type="submit">Search</button>
            </form>
            <table>
                <tr>
                    <th>Major_id</th>
                    <th>Major_img</th>
                    <th>major_code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Chức năng</th>
                </tr>
                <?php
                if (isset($_GET['search_major'])) {
                    $search_major = $_GET['search_major'];
                    $sql_major = "SELECT * FROM major WHERE name LIKE '%$search_major%'";
                } else {
                    $sql_major =  "SELECT * FROM major";
                }
                $result_major = $conn->query($sql_major);
                if ($result_major->num_rows > 0) {
                    while ($row_major = $result_major->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row_major['major_id']; ?></td>
                            <td><img src="<?php echo $row_major['major_img']; ?>" alt=""></td>
                            <td><?php echo $row_major['major_code']; ?></td>
                            <td><?php echo $row_major['name']; ?></td>
                            <td><?php echo $row_major['description']; ?></td>
                            <td><a href="update.php?major_id=<?php echo $row_major['major_id']; ?>">Sửa</a> | <a href="delete.php?major_id=<?php echo $row_major['major_id']; ?>">Xóa</a></td>
                        </tr>
                <?php }
                }
                ?>
            </table>
            <a class="btn" href="./add_major.php">Thêm chuyên ngành</a>


        </div>
    <?php }
    ?>
</body>

</html>