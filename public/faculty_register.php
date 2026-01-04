<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Faculty Registration</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="card">
    <h2>Faculty Registration</h2>

    <form action="../backend/faculty_register_action.php" method="POST">

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="text" name="username" placeholder="Username" required>

        <input type="text" name="department" placeholder="Department" required>

        <input type="email" name="email" placeholder="Email ID" required>

        <input type="text" name="contact" placeholder="Contact Number" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Register</button>
    </form>
<p style="margin-top:10px; text-align:center;">
    If you already have an account,
    <a href="faculty_login.php">log in</a>
</p>
</div>

</body>
</html>
