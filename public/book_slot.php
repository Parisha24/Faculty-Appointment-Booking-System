<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="card">
    <h2>Book Appointment</h2>

    <form action="../backend/book_appointment_action.php" method="POST">

        <!-- Faculty Selection -->
        <select name="faculty_id" id="faculty" required>
            <?php include "../backend/get_faculty.php"; ?>
        </select>

        <!-- Slot Selection -->
        <select name="slot_id" id="slot" required>
            <option value="">Select Time Slot</option>
        </select>

        <!-- Mandatory Description -->
        <textarea name="description"
                  placeholder="Describe your reason for appointment"
                  rows="3"
                  required></textarea>

        <button type="submit">Book Appointment</button>
    </form>
</div>

<script>
document.getElementById("faculty").addEventListener("change", function () {
    fetch("../backend/get_slots.php?faculty_id=" + this.value)
        .then(res => res.text())
        .then(data => document.getElementById("slot").innerHTML = data);
});
</script>

</body>
</html>
