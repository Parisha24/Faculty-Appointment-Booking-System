<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit;
}

include "../backend/db_connect.php";

$student_db_id = $_SESSION['student_id'];

/* Fetch student details */
$student = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT name, student_id 
    FROM users 
    WHERE user_id = '$student_db_id'
"));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="card">
    <h2>Student Dashboard</h2>

    <p><strong>Name:</strong> <?php echo htmlspecialchars($student['name']); ?></p>
    <p><strong>Enrollment ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></p>

    <hr style="margin:20px 0;">
    <div style="margin:15px 0; text-align:center;">
    <a href="book_slot.php">
        <button>➕ Book New Appointment</button>
    </a>
</div>

    <h3>Appointment History</h3>

    <table width="100%" border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Appointment ID</th>
            <th>Faculty</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Faculty Remark</th>
        </tr>

        <?php
        $history = mysqli_query($conn, "
            SELECT 
                a.appointment_id,
                u.name AS faculty_name,
                s.slot_date,
                s.start_time,
                s.end_time,
                a.status,
                a.faculty_remark
            FROM appointments a
            JOIN slots s ON a.slot_id = s.slot_id
            JOIN users u ON s.faculty_id = u.user_id
            WHERE a.student_id = '$student_db_id'
            ORDER BY a.appointment_id DESC
        ");

        if (mysqli_num_rows($history) == 0) {
            echo "<tr><td colspan='6' align='center'>No appointments booked yet</td></tr>";
        }

        while ($row = mysqli_fetch_assoc($history)) {

            if ($row['status'] == 'Pending') {
                $color = 'orange';
            } elseif ($row['status'] == 'Approved') {
                $color = 'green';
            } else {
                $color = 'red';
            }

            echo "
            <tr>
                <td>{$row['appointment_id']}</td>
                <td>{$row['faculty_name']}</td>
                <td>{$row['slot_date']}</td>
                <td>{$row['start_time']} - {$row['end_time']}</td>
                <td style='color:$color;font-weight:bold;'>{$row['status']}</td>
                <td>".($row['faculty_remark'] ?: '-')."</td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
