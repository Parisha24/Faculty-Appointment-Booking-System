<?php
include "db_connect.php";

/*
For demo simplicity:
We show ALL pending appointments.
(You can later filter by faculty if needed)
*/

$query = "
SELECT 
    a.appointment_id,
    u.name AS student_name,
    s.slot_date,
    s.start_time,
    s.end_time
FROM appointments a
JOIN users u ON a.student_id = u.user_id
JOIN slots s ON a.slot_id = s.slot_id
WHERE a.status = 'pending'
";

$result = mysqli_query($conn, $query);

echo "<option value=''>Select Appointment</option>";

while ($row = mysqli_fetch_assoc($result)) {
    $label = "ID {$row['appointment_id']} | {$row['student_name']} | {$row['slot_date']} {$row['start_time']}-{$row['end_time']}";
    echo "<option value='{$row['appointment_id']}'>$label</option>";
}
?>
