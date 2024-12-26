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
                    <li class="header_item"><a href="course.php" class="header_link">Khóa học</a></li>
                    <li class="header_item"><a href="user_course.php" class="header_link active">Người dùng đky khóa học</a></li>
                </ul>
                <a href="../pages/logout.php">Đăng xuất</a>
            </div>
        </header>


        <div class="container">
            <!-- USERS_COURSES -->
            <h3>Bảng USER_COURSES</h3>
            <form action="">
                <input type="number" name="search_course_user" placeholder="Tìm kiếm">
                <button type="submit">Search</button>
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>UserID</th>
                    <th>CourseID</th>
                    <th>Registered_at</th>
                    <th>Chức năng</th>
                </tr>
                <?php
                if (isset($_GET['search_course_user'])) {
                    $search_course_user = $_GET['search_course_user'];
                    $sql_user_course = "SELECT * FROM user_courses WHERE user_id LIKE '%$search_course_user%' OR course_id LIKE '%$search_course_user%'";
                } else {
                    $sql_user_course =  "SELECT * FROM user_courses";
                }
                $result_user_course = $conn->query($sql_user_course);
                if ($result_user_course->num_rows > 0) {
                    while ($row_user_course = $result_user_course->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row_user_course['id']; ?></td>
                            <td><?php echo $row_user_course['user_id']; ?></td>
                            <td><?php echo $row_user_course['course_id']; ?></td>
                            <td><?php echo $row_user_course['registered_at']; ?></td>
                            <td><a href="../pages/account.php?user_id=<?php echo $row_user_course['user_id']; ?>">Xem khoá học</a></td>
                        </tr>
                <?php }
                }
                ?>
            </table>

        </div>
    <?php }
    ?>
</body>

</html>