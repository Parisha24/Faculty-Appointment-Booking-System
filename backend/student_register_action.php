<?php
include "db_connect.php";

$name       = $_POST['name'];
$student_id = $_POST['student_id'];
$email      = $_POST['email'];
$contact    = $_POST['contact'];
$dept       = $_POST['department'];
$sem        = $_POST['semester'];
$pass       = password_hash($_POST['password'], PASSWORD_DEFAULT);

/* Prevent duplicate student ID */
$check = mysqli_query($conn,
    "SELECT * FROM users WHERE student_id='$student_id'"
);

if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('Student ID already registered');history.back();</script>";
    exit;
}

mysqli_query($conn,
"INSERT INTO users
 (name, student_id, email, contact, department, semester, password, role)
 VALUES
 ('$name','$student_id','$email','$contact','$dept','$sem','$pass','student')"
);

echo "<script>alert('Registration successful. Please login.');location.href='../public/student_login.php';</script>";
?>
