<?php
$link=mysqli_connect('localhost','root','','car_share');
if(mysqli_connect_error()){
	die("ERROR: Unable to connect:".mysqli_connect_error());
}
?>