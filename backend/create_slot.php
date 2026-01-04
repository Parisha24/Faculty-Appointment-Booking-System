<?php
include "db_connect.php";
session_start();

if (!isset($_SESSION['faculty_id'])) {
    header("Location: ../public/faculty_login.php");
    exit;
}

$faculty_id = $_SESSION['faculty_id'];
$date       = $_POST['slot_date'];
$start      = $_POST['start_time'];
$end        = $_POST['end_time'];

mysqli_query($conn,
"INSERT INTO slots (faculty_id, slot_date, start_time, end_time)
 VALUES ('$faculty_id','$date','$start','$end')"
);

echo "<script>alert('Slot created successfully');history.back();</script>";
?>
