<?php
include "db_connect.php";
session_start();

$username = $_POST['username'];
$pass     = $_POST['password'];

$result = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$username' AND role='faculty'"
);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($pass, $row['password'])) {
        $_SESSION['faculty_id']   = $row['user_id'];
        $_SESSION['faculty_name'] = $row['name'];

        header("Location: ../public/faculty_dashboard.php");

        exit;
    }
}

echo "<script>alert('Invalid Username or Password');history.back();</script>";
?>
