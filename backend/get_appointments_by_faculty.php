<?php
include "db_connect.php";

$faculty_id = $_GET['faculty_id'];

$query = "
SELECT 
    a.appointment_id,
    u.name AS student_name,
    s.slot_date,
    s.start_time,
    s.end_time,
    a.student_message
FROM appointments a
JOIN slots s ON a.slot_id = s.slot_id
JOIN users u ON a.student_id = u.user_id
WHERE s.faculty_id = '$faculty_id'
  AND a.status = 'pending'
";

$result = mysqli_query($conn, $query);

echo "<option value=''>Select Appointment</option>";

while ($row = mysqli_fetch_assoc($result)) {
    $label = "ID {$row['appointment_id']} | {$row['student_name']} | {$row['slot_date']} {$row['start_time']}-{$row['end_time']} | {$row['student_message']}";
    echo "<option value='{$row['appointment_id']}'>$label</option>";
}
?>
