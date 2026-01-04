<?php
include "db_connect.php";

$id=$_POST['appointment_id'];
$st=$_POST['status'];

mysqli_query($conn,
"UPDATE appointments SET status='$st' WHERE appointment_id='$id'");

if($st=='rejected'){
$r=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT slot_id FROM appointments WHERE appointment_id='$id'"));
mysqli_query($conn,
"UPDATE slots SET is_available=1 WHERE slot_id='{$r['slot_id']}'");
}

echo "<script>alert('Status updated');history.back();</script>";
?>
