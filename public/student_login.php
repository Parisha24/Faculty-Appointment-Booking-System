<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="card">
    <h2>Student Login</h2>

    <form action="../backend/student_login_action.php" method="POST">

        <input type="text" name="student_id" placeholder="Student ID" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
