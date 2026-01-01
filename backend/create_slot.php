<?php
include "db_connect.php";

$faculty_id = $_POST['faculty_id'];
$slot_date  = $_POST['slot_date'];
$start_time = $_POST['start_time'];

// 1-hour slot
$end_time = date("H:i:s", strtotime($start_time . " +1 hour"));

$query = "INSERT INTO slots (faculty_id, slot_date, start_time, end_time)
          VALUES ('$faculty_id', '$slot_date', '$start_time', '$end_time')";

mysqli_query($conn, $query);

echo "Slot created successfully";
?>
