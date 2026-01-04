<?php
include "db_connect.php";
$f = $_GET['faculty_id'];

$r = mysqli_query($conn,
"SELECT slot_id,slot_date,start_time,end_time
 FROM slots WHERE faculty_id='$f' AND is_available=1");

echo "<option>Select Time Slot</option>";
while($row=mysqli_fetch_assoc($r)){
$label = $row['slot_date']." ".$row['start_time']."-".$row['end_time'];
echo "<option value='{$row['slot_id']}'>$label</option>";
}
?>
