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
    if (isset($_SESSION['username'])) {
        if ($_SESSION['role'] == 'admin') {
    ?>
            <header class="header">
                <div class="header_inner">
                    <ul class="header_list">
                        <li class="header_item"><a href="index.php" class="header_link active">Trang chủ</a></li>
                        <li class="header_item"><a href="user.php" class="header_link">Quản lý User</a></li>
                        <li class="header_item"><a href="major.php" class="header_link">Chuyên ngành</a></li>
                        <li class="header_item"><a href="course.php" class="header_link">Khóa học</a></li>
                        <li class="header_item"><a href="user_course.php" class="header_link">Người dùng đky khóa học</a></li>
                    </ul>
                    <a href="../pages/logout.php">Đăng xuất</a>
                </div>
            </header>


            <div class="container">
                <h2>Chào mừng đến với trang dành cho ADMIN</h2>

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

                <!-- USERS_COURSES -->
                <h3>Bảng USER_COURSES</h3>
                <form class="index" action="">
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
                                <td><a href="update.php?user_id=<?php echo $row_user_course['user_id']; ?>">Sửa</a> | <a href="delete.php?user_id=<?php echo $row_user_course['user_id']; ?>">Xóa</a></td>
                            </tr>
                    <?php }
                    }
                    ?>
                </table>

            </div>
    <?php } else {
            echo "Bạn không có quyền truy cập trang này" . "<a href='../index.php'>Về trang chủ</a>";
        }
    } else {
        header("location: ../pages/login.php");
    }
    ?>
</body>

</html>