<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['faculty_id'])) {
    header("Location: ../public/faculty_login.php");
    exit;
}

$appointment_id = $_POST['appointment_id'];
$action         = $_POST['action'];
$remark         = $_POST['remark'] ?? null;

/* Update status */
if ($action == 'Approved') {
    mysqli_query($conn, "
        UPDATE appointments 
        SET status='Approved', faculty_remark=NULL
        WHERE appointment_id='$appointment_id'
    ");
}

if ($action == 'Rejected') {
    mysqli_query($conn, "
        UPDATE appointments 
        SET status='Rejected', faculty_remark='$remark'
        WHERE appointment_id='$appointment_id'
    ");
}

/* 🔴 IMPORTANT: redirect to dashboard */
header("Location: ../public/faculty_dashboard.php");
exit;
