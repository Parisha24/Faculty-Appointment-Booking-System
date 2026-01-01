<?php
include "db_connect.php";

$appointment_id = $_POST['appointment_id'];
$status = $_POST['status']; // approved or rejected

// Update appointment status
$query = "UPDATE appointments SET status = '$status'
          WHERE appointment_id = '$appointment_id'";
mysqli_query($conn, $query);

// If rejected, make slot available again
if ($status == 'rejected') {
    $slot_query = "UPDATE slots 
                   SET is_available = TRUE 
                   WHERE slot_id = (
                       SELECT slot_id FROM appointments 
                       WHERE appointment_id = '$appointment_id'
                   )";
    mysqli_query($conn, $slot_query);
}

echo "Appointment status updated";
?>
