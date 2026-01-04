<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="card">
    <h2>Student Registration</h2>

    <form action="../backend/student_register_action.php" method="POST">

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="text" name="student_id" placeholder="Student ID (Enrollment No)" required>

        <input type="email" name="email" placeholder="Email ID" required>

        <input type="text" name="contact" placeholder="Contact Number" required>

        <input type="text" name="department" placeholder="Department" required>

        <input type="text" name="semester" placeholder="Semester" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Register</button>
    </form>
<p style="margin-top:10px; text-align:center;">
    If you already have an account,
    <a href="student_login.php">log in</a>
</p>
</div>

</body>
</html>
