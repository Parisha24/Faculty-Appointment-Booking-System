<?php
include "db_connect.php";
session_start();

$student_id = $_POST['student_id'];
$pass       = $_POST['password'];

$result = mysqli_query($conn,
    "SELECT * FROM users WHERE student_id='$student_id' AND role='student'"
);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($pass, $row['password'])) {
        $_SESSION['student_id'] = $row['user_id'];
        $_SESSION['student_name'] = $row['name'];

        header("Location: ../public/student_dashboard.php");
        exit;
    }
}

echo "<script>alert('Invalid Student ID or Password');history.back();</script>";
?>
