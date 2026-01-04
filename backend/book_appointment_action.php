<?php
include "db_connect.php";
session_start();

/* Student must be logged in */
if (!isset($_SESSION['student_id'])) {
    header("Location: ../public/student_login.php");
    exit;
}

$student_id = $_SESSION['student_id'];
$slot_id    = $_POST['slot_id'];
$desc       = trim($_POST['description']);

/* Description is mandatory */
if ($desc == "") {
    echo "<script>alert('Description is mandatory');history.back();</script>";
    exit;
}

/* Insert appointment with STRICT Pending status */
mysqli_query($conn,
"INSERT INTO appointments (slot_id, student_id, description, status)
 VALUES ('$slot_id','$student_id','$desc','Pending')"
);

/* Make slot unavailable */
mysqli_query($conn,
"UPDATE slots SET is_available=0 WHERE slot_id='$slot_id'"
);

echo "<script>alert('Appointment booked. Status: Pending');location.href='../public/student_history.php';</script>";
?>
