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
        if ($_SESSION['role'] == 'admin') {
        ?>
            <form class="form" action="" method="post">
                <h3 class="title">Thêm dữ liệu MAJOR</h3>
                <div class="form_group">
                    <label>Ảnh</label>
                    <input type="text" name="major_img" placeholder="Link ảnh" require>
                </div>
                <div class="form_group">
                    <label>Mã chuyên ngành</label>
                    <input type="text" name="ajor_code" placeholder="Mã" require>
                </div>
                <div class="form_group">
                    <label>Tên chuyên ngành </label>
                    <input type="text" name="name" placeholder="Tên" require>
                </div>
                <div class="form_group">
                    <label>Mô tả</label>
                    <input type="text" name="description" placeholder="Mô tả" require>
                </div>
                <input class="btn" type="submit" name="submit" value="Thêm">
            </form>
        <?php }
        ?>
    </div>
</body>

</html>

<!-- USER -->
<?php
if (isset($_POST['submit'])) {
    $major_img = $_POST['major_img'];
    $major_code = $_POST['major_code'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql_update_user = "INSERT INTO major (major_img, major_code, name, description) VALUES ('$major_img', '$major_code', '$name', '$description')";

    if ($conn->query($sql_update_user) === TRUE) {
        header("location: ./major.php");
    } else {
        echo "Lỗi: " . $sql_update_user . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!-- MAJOR -->
<?php
if (isset($_POST['major_id']) && isset($_POST['major_img'])) {
    $major_id = $_POST['major_id'];
    $major_img = $_POST['major_img'];
    $major_code = $_POST['major_code'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql_update_major = "UPDATE major SET major_img='$major_img', name='$name', description='$description', major_code='$major_code' WHERE major_id='$major_id'";

    if ($conn->query($sql_update_major) === TRUE) {
        header("location: ./major.php");
    } else {
        echo "Lỗi: " . $sql_update_major . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!-- COURSE -->
<?php
if (isset($_POST['course_id']) && isset($_POST['course_name'])) {
    $course_id = $_POST['course_id'];
    $course_img = $_POST['course_img'];
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $video = $_POST['video'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];
    $major_id = $_POST['major_id'];

    $sql_update_course = "UPDATE course_major SET course_img='$course_img', course_name='$course_name', description='$description', course_code='$course_code', course_name='$course_name' , video='$video' , rating='$rating' , price='$price', major_id='$major_id'WHERE course_id='$course_id'";

    if ($conn->query($sql_update_course) === TRUE) {
        header("location: ./course.php");
    } else {
        echo "Lỗi: " . $sql_update_course . "<br>" . $conn->error;
    }
    $conn->close();
}
?>