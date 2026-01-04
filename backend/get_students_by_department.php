<?php
include "db_connect.php";

$dept = $_GET['dept'];

$result = mysqli_query($conn,
    "SELECT enrollment_no 
     FROM users 
     WHERE role='student' AND department='$dept'"
);

echo "<option value=''>Select Enrollment Number</option>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='{$row['enrollment_no']}'>
            {$row['enrollment_no']}
          </option>";
}
?>
