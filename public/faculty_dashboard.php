<?php
session_start();
if (!isset($_SESSION['faculty_id'])) {
    header("Location: faculty_login.php");
    exit;
}

include "../backend/db_connect.php";
$faculty_id   = $_SESSION['faculty_id'];
$faculty_name = $_SESSION['faculty_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="card">
    <h2>Faculty Dashboard</h2>
    <p><strong>Welcome, <?php echo htmlspecialchars($faculty_name); ?></strong></p>

    <!-- ================= CREATE SLOT ================= -->
    <h3>Create Time Slot</h3>
    <form action="../backend/create_slot.php" method="POST">
        <input type="date" name="slot_date" required>
        <input type="time" name="start_time" required>
        <input type="time" name="end_time" required>
        <button type="submit">Create Slot</button>
    </form>

    <hr style="margin:20px 0;">

    <!-- ================= PENDING APPOINTMENTS ================= -->
    <h3>Pending Appointment Requests</h3>

    <table width="100%" border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Sr No</th>
            <th>Student ID</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>

        <?php
        $pending = mysqli_query($conn, "
            SELECT 
                a.appointment_id,
                u.student_id,
                a.description
            FROM appointments a
            JOIN slots s ON a.slot_id = s.slot_id
            JOIN users u ON a.student_id = u.user_id
            WHERE s.faculty_id='$faculty_id'
              AND a.status='Pending'
            ORDER BY a.appointment_id ASC
        ");

        if (mysqli_num_rows($pending) == 0) {
            echo "<tr><td colspan='4' align='center'>No pending requests</td></tr>";
        }

        $sr = 1;
        while ($row = mysqli_fetch_assoc($pending)) {
            echo "
            <tr>
                <td>{$sr}</td>
                <td>{$row['student_id']}</td>
                <td>{$row['description']}</td>
                <td>
                    <!-- Approve -->
                    <form action='../backend/faculty_action.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='appointment_id' value='{$row['appointment_id']}'>
                        <input type='hidden' name='action' value='Approved'>
                        <button type='submit' style='color:green;'>🟢 Approve</button>
                    </form>

                    <!-- Reject -->
                    <form action='../backend/faculty_action.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='appointment_id' value='{$row['appointment_id']}'>
                        <input type='hidden' name='action' value='Rejected'>
                        <input type='text' name='remark'
                               placeholder='Rejection reason'
                               required>
                        <button type='submit' style='color:red;'>🔴 Reject</button>
                    </form>
                </td>
            </tr>";
            $sr++;
        }
        ?>
    </table>

    <hr style="margin:20px 0;">

    <!-- ================= DECISION HISTORY ================= -->
    <h3>Appointment History</h3>

    <table width="100%" border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Appointment ID</th>
            <th>Student ID</th>
            <th>Description</th>
            <th>Status</th>
            <th>Remark</th>
        </tr>

        <?php
        $history = mysqli_query($conn, "
            SELECT 
                a.appointment_id,
                u.student_id,
                a.description,
                a.status,
                a.faculty_remark
            FROM appointments a
            JOIN slots s ON a.slot_id = s.slot_id
            JOIN users u ON a.student_id = u.user_id
            WHERE s.faculty_id='$faculty_id'
              AND a.status IN ('Approved','Rejected')
            ORDER BY a.appointment_id DESC
        ");

        if (mysqli_num_rows($history) == 0) {
            echo "<tr><td colspan='5' align='center'>No history yet</td></tr>";
        }

        while ($row = mysqli_fetch_assoc($history)) {
            $color = ($row['status'] == 'Approved') ? 'green' : 'red';

            echo "
            <tr>
                <td>{$row['appointment_id']}</td>
                <td>{$row['student_id']}</td>
                <td>{$row['description']}</td>
                <td style='color:$color;font-weight:bold;'>{$row['status']}</td>
                <td>".($row['faculty_remark'] ?: '-')."</td>
            </tr>";
        }
        ?>
    </table>

</div>

</body>
</html>

