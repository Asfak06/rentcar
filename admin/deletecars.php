<?php
//start session and connect
session_start();
include('../connection.php');
$sql="DELETE FROM garage WHERE car_id='".$_POST['car_id']."'";
$result = mysqli_query($link, $sql);
?>