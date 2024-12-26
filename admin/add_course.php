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
        <form action="" method="post">
            <h3>Thêm dữ liệu COURSE</h3>
            <div class="form_group">
                <label>course_img</label>
                <input type="text" name="course_img" placeholder="course_img" require>
            </div>
            <div class="form_group">
                <label>course_code</label>
                <input type="text" name="course_code" placeholder="course_code" require>
            </div>
            <div class="form_group">
                <label>course_name</label>
                <input type="text" name="course_name" placeholder="course_name" require>
            </div>
            <div class="form_group">
                <label>description</label>
                <input type="text" name="description" placeholder="course_img" require>
            </div>
            <div class="form_group">
                <label>video</label>
                <input type="text" name="video" placeholder="video" require>
            </div>
            <div class="form_group">
                <label>rating</label>
                <input type="text" name="rating" placeholder="rating" require>
            </div>
            <div class="form_group">
                <label>price</label>
                <input type="text" name="price" placeholder="price" require>
            </div>
            <div class="form_group">
                <label>major_id</label>
                <input type="text" name="major_id" placeholder="major_id" require>
            </div>
            <input type="submit" name="submit" value="Thêm">
        </form>
    <?php }
    ?>
</body>

</html>

<!-- USER -->
<?php
if (isset($_POST['submit'])) {
    $course_img = $_POST['course_img'];
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $video = $_POST['video'];
    $video = $_POST['video'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];
    $major_id = $_POST['major_id'];

    $sql_update_user = "INSERT INTO course_major (course_img, course_code, course_name, description, video, rating, price, major_id) VALUES ('$course_img', '$course_code', '$course_name', '$description', '$video' , '$rating' , '$price' , '$major_id' )";

    if ($conn->query($sql_update_user) === TRUE) {
        header("location: ./course.php");
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