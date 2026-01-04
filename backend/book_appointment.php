<?php
include "db_connect.php";

$enrollment = $_POST['student_enrollment'];
$faculty_id = $_POST['faculty_id'];
$slot_id    = $_POST['slot_id'];
$message    = $_POST['student_message'];

/* Get student ID from enrollment number */
$q = mysqli_query($conn,
    "SELECT user_id FROM users 
     WHERE enrollment_no='$enrollment' AND role='student'"
);

$row = mysqli_fetch_assoc($q);
$student_id = $row['user_id'];

/* Insert appointment */
mysqli_query($conn,
    "INSERT INTO appointments (slot_id, student_id, student_message)
     VALUES ('$slot_id', '$student_id', '$message')"
);

/* Mark slot unavailable */
mysqli_query($conn,
    "UPDATE slots SET is_available = 0 WHERE slot_id = '$slot_id'"
);

echo "<script>
alert('Appointment request submitted successfully');
history.back();
</script>";
?>
