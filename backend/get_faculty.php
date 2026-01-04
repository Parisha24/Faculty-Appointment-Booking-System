<?php
include "db_connect.php";
$r = mysqli_query($conn,"SELECT user_id,name FROM users WHERE role='faculty'");
echo "<option>Select Faculty</option>";
while($row=mysqli_fetch_assoc($r)){
echo "<option value='{$row['user_id']}'>{$row['name']}</option>";
}
?>
