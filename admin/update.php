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
        <?php
        //  USERS 
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $sql_user = "SELECT * FROM users WHERE user_id = '$user_id'";
            $result_user = mysqli_query($conn, $sql_user);
            $row_user = mysqli_fetch_assoc($result_user);
        ?>
            <form action="" method="post">
                <input type="text" name="user_id" value="<?php echo $row_user['user_id']; ?>" hidden>
                <div class="form_group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $row_user['username']; ?>">
                </div>
                <div class="form_group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $row_user['email']; ?>">
                </div>
                <div class="form_group">
                    <label>Fullname</label>
                    <input type="text" name="fullname" value="<?php echo $row_user['fullname']; ?>">
                </div>
                <div class="form_group">
                    <label>Gender</label>
                    <input type="text" name="gender" value="<?php echo $row_user['gender']; ?>">
                </div>
                <input type="submit" name="submit" value="Update">
            </form>
        <?php } ?>


        <?php
        //  MAJOR 
        if (isset($_GET['major_id'])) {
            $major_id = $_GET['major_id'];
            $sql_major = "SELECT * FROM major WHERE major_id = '$major_id'";
            $result_major = mysqli_query($conn, $sql_major);
            $row_major = mysqli_fetch_assoc($result_major);
        ?>
            <form action="" method="post">
                <input type="text" name="major_id" value="<?php echo $row_major['major_id']; ?>" hidden>
                <div class="form_group">
                    <label>Image</label>
                    <input type="text" name="major_img" value="<?php echo $row_major['major_img']; ?>">
                </div>
                <div class="form_group">
                    <label>Code</label>
                    <input type="text" name="major_code" value="<?php echo $row_major['major_code']; ?>">
                </div>
                <div class="form_group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo $row_major['name']; ?>">
                </div>
                <div class="form_group">
                    <label>Description</label>
                    <input type="text" name="description" value="<?php echo $row_major['description']; ?>">
                </div>
                <input type="submit" name="submit" value="Update">
            </form>
        <?php } ?>


        <?php
        //  COURSE 
        if (isset($_GET['course_id'])) {
            $course_id = $_GET['course_id'];
            $sql_course = "SELECT * FROM course_major WHERE course_id = '$course_id'";
            $result_course = mysqli_query($conn, $sql_course);
            $row_course = mysqli_fetch_assoc($result_course);
        ?>
            <form action="" method="post">
                <input type="text" name="course_id" value="<?php echo $row_course['course_id']; ?>" hidden>
                <div class="form_group">
                    <label>Image</label>
                    <input type="text" name="course_img" value="<?php echo $row_course['course_img']; ?>">
                </div>
                <div class="form_group">
                    <label>Code</label>
                    <input type="text" name="course_code" value="<?php echo $row_course['course_code']; ?>">
                </div>
                <div class="form_group">
                    <label>Name</label>
                    <input type="text" name="course_name" value="<?php echo $row_course['course_name']; ?>">
                </div>
                <div class="form_group">
                    <label>Description</label>
                    <input type="text" name="description" value="<?php echo $row_course['description']; ?>">
                </div>
                <div class="form_group">
                    <label>Video</label>
                    <input type="text" name="video" value="<?php echo $row_course['video']; ?>">
                </div>
                <div class="form_group">
                    <label>rating</label>
                    <input type="text" name="rating" value="<?php echo $row_course['rating']; ?>">
                </div>
                <div class="form_group">
                    <label>Price</label>
                    <input type="text" name="price" value="<?php echo $row_course['price']; ?>">
                </div>
                <div class="form_group">
                    <label>Major ID</label>
                    <input type="text" name="major_id" value="<?php echo $row_course['major_id']; ?>">
                </div>
                <input type="submit" name="submit" value="Update">
            </form>
        <?php } ?>
    <?php }
    ?>
</body>

</html>

<!-- USER -->
<?php
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];

    $sql_update_user = "UPDATE users SET username='$username', fullname='$fullname', gender='$gender', email='$email' WHERE user_id='$user_id'";

    if ($conn->query($sql_update_user) === TRUE) {
        header("location: ./user.php");
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