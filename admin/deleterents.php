<?php
//start session and connect
session_start();
include('../connection.php');

$car_id=$_POST['car_id'];

$user_id=$_POST['user_id'];

$sql="DELETE FROM rents WHERE `car_id`='$car_id' AND `user_id`='$user_id' ";
$result = mysqli_query($link, $sql);

$sql2="UPDATE garage SET `status`='available' WHERE `car_id`='$car_id' ";
$result2 = mysqli_query($link, $sql2);


?>