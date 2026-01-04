<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Faculty Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="card">
    <h2>Faculty Login</h2>

    <form action="../backend/faculty_login_action.php" method="POST">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
