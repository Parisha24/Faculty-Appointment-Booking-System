<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../assets/style.css">
<title>Faculty Availability</title>
</head>
<body>

<div class="card">
<h2>Faculty Availability</h2>
<p class="subtitle">Create your available time slots</p>

<form action="../backend/create_slot.php" method="POST">
<input type="date" name="slot_date" required>
<input type="time" name="start_time" required>
<button>Create Slot</button>
</form>
</div>

</body>
</html>
