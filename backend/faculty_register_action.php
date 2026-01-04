<?php
include "db_connect.php";

$name     = $_POST['name'];
$username = $_POST['username'];
$dept     = $_POST['department'];
$email    = $_POST['email'];
$contact  = $_POST['contact'];
$pass     = password_hash($_POST['password'], PASSWORD_DEFAULT);

/* Prevent duplicate username */
$check = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$username'"
);

if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('Username already exists');history.back();</script>";
    exit;
}

mysqli_query($conn,
"INSERT INTO users
 (name, username, department, email, contact, password, role)
 VALUES
 ('$name','$username','$dept','$email','$contact','$pass','faculty')"
);

echo "<script>alert('Faculty registered successfully. Please login.');location.href='../public/faculty_login.php';</script>";
?>
