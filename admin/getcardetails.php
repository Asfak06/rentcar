<?php
//start session and connect
session_start();
include('../connection.php');

$sql="SELECT * FROM garage WHERE car_id='".$_POST['car_id']."'"; 
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$array = array("car_id"=>$row['car_id'], "cars"=>$row['cars'], "brand"=>$row['brand'], "model"=>$row['model'], "capacity"=>$row['capacity'], "status"=>$row['status']);
echo json_encode($array);

?>
 