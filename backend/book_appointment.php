<?php
include "db_connect.php";

$slot_id   = $_POST['slot_id'];
$student_id = $_POST['student_id'];

/* Check if slot is available */
$check = "SELECT is_available FROM slots WHERE slot_id = '$slot_id'";
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);

if ($row['is_available']) {

    // Book appointment
    $query = "INSERT INTO appointments (slot_id, student_id)
              VALUES ('$slot_id', '$student_id')";
    mysqli_query($conn, $query);

    // Mark slot unavailable
    $update = "UPDATE slots SET is_available = FALSE WHERE slot_id = '$slot_id'";
    mysqli_query($conn, $update);

    echo "Appointment booked successfully";
} else {
    echo "Slot not available";
}
?>
