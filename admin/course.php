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
                    <li class="header_item"><a href="major.php" class="header_link">Chuyên ngành</a></li>
                    <li class="header_item"><a href="course.php" class="header_link active">Khóa học</a></li>
                    <li class="header_item"><a href="user_course.php" class="header_link">Người dùng đky khóa học</a></li>
                </ul>
                <a href="../pages/logout.php">Đăng xuất</a>
            </div>
        </header>


        <div class="container">
            <!-- COURSE -->
            <h3>Bảng COURSE</h3>
            <form class="index" action="">
                <input type="text" name="search_course" placeholder="Tìm kiếm">
                <button type="submit">Search</button>
            </form>
            <table>
                <tr>
                    <th>Course_id</th>
                    <th>Image</th>
                    <th>Course_code</th>
                    <th>Name</th>
                    <th>Desciption</th>
                    <th>Videos</th>
                    <th>Rating</th>
                    <th>Price</th>
                    <th>Major_id</th>
                    <th>Chức năng</th>
                </tr>
                <?php
                if (isset($_GET['search_course'])) {
                    $search_course = $_GET['search_course'];
                    $sql_course = "SELECT * FROM course_major WHERE course_name LIKE '%$search_course%'";
                } else {
                    $sql_course =  "SELECT * FROM course_major";
                }
                $result_course = $conn->query($sql_course);
                if ($result_course->num_rows > 0) {
                    while ($row_course = $result_course->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row_course['course_id']; ?></td>
                            <td><img src="<?php echo $row_course['course_img']; ?>" alt=""></td>
                            <td><?php echo $row_course['course_code']; ?></td>
                            <td><?php echo $row_course['course_name']; ?></td>
                            <td><?php echo $row_course['description']; ?></td>
                            <td><?php echo $row_course['video']; ?></td>
                            <td><?php echo $row_course['rating']; ?></td>
                            <td><?php echo $row_course['price']; ?></td>
                            <td><?php echo $row_course['major_id']; ?></td>
                            <td><a href="update.php?course_id=<?php echo $row_course['course_id']; ?>">Sửa</a> | <a href="delete.php?course_id=<?php echo $row_course['course_id']; ?>">Xóa</a></td>
                        </tr>
                <?php }
                }
                ?>
            </table>
            <a href="./add_course.php" class="btn">Thêm</a>
        </div>
    <?php }
    ?>
</body>

</html>