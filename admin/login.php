<?php
session_start();
if($_POST["pass"]=='1234'){
	$_SESSION['pass']='1234';
	echo "success";
}
?>