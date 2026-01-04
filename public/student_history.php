<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit;
}

include "../backend/db_connect.php";
$student_id = $_SESSION['student_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appointment History</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="card">
    <h2>My Appointment History</h2>
    <div style="text-align:right; margin-bottom:10px;">
    <a href="logout.php">
        <button>Logout</button>
    </a>
</div>
    <table width="100%" cellpadding="8" cellspacing="0" border="1">
        <tr>
            <th>Appointment ID</th>
            <th>Faculty</th>
            <th>Date</th>
            <th>Time Slot</th>
            <th>Status</th>
            <th>Faculty Remark</th>
        </tr>

        <?php
        $q = mysqli_query($conn, "
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
            WHERE a.student_id = '$student_id'
            ORDER BY a.appointment_id DESC
        ");

        if (mysqli_num_rows($q) == 0) {
            echo "<tr><td colspan='6' align='center'>No appointments yet</td></tr>";
        }

        while ($row = mysqli_fetch_assoc($q)) {

            // Status color
            if ($row['status'] == 'Pending') {
                $color = 'orange';
            } elseif ($row['status'] == 'Approved') {
                $color = 'green';
            } else {
                $color = 'red';
            }

            echo "<tr>
                    <td>{$row['appointment_id']}</td>
                    <td>{$row['faculty_name']}</td>
                    <td>{$row['slot_date']}</td>
                    <td>{$row['start_time']} - {$row['end_time']}</td>
                    <td style='color:$color;font-weight:bold'>
                        {$row['status']}
                    </td>
                    <td>
                        ".($row['status']=='Rejected' ? $row['faculty_remark'] : '-')."
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

