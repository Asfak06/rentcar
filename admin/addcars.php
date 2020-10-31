<?php
//start session and connect
session_start();
include('../connection.php');

//define error messages
$missingcategory = '<p><strong>Please select a category!</strong></p>';
$missingbrand = '<p><strong>Please enter brand name!</strong></p>';
$missingmodel = '<p><strong>Please enter model!</strong></p>';
$missingcapacity = '<p><strong>Please select the number of available seats!</strong></p>';
$invalidcapacity = '<p><strong>The number of available seats should contain digits only!</strong></p>';
$missingstatus = '<p><strong>Please select status, available or on-trip!</strong></p>';

//Get inputs:

$brand = $_POST["brand"];
$model = $_POST["model"];
$capacity = $_POST["capacity"];

if(!isset($_POST["cars"])){
    $cars ="";
}else{
    $cars =$_POST["cars"];
}

if(!isset($_POST["status"])){
    $status ="";
}else{
    $status =$_POST["status"];
}

$errors ="";

if(!$cars){
    $errors .= $missingcategory;   
}else{
    $cars = filter_var($cars, FILTER_SANITIZE_STRING); 
}

if(!$brand){
    $errors .= $missingbrand;   
}else{
    $brand = filter_var($brand, FILTER_SANITIZE_STRING); 
}

if(!$model){
    $errors .= $missingmodel;   
}else{
    $model = filter_var($model, FILTER_SANITIZE_STRING); 
}

if(!$capacity){
    $errors .= $missingcapacity;   
}else{
    $capacity = filter_var($capacity, FILTER_SANITIZE_STRING); 
}


if(!$status){
    $errors .= $missingstatus;    
}

if($errors){
    $resultMessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultMessage;
}else{
    $tbl_name = 'garage';
    $sql = "INSERT INTO $tbl_name (`cars`, `brand`, `model`,`capacity`, `status`) VALUES ('$cars','$brand','$model','$capacity','$status')";   
    $results = mysqli_query($link, $sql);
    if(!$results){
        echo '<div class=" alert alert-danger">There was an error! The trip could not be added to database!</div>';        
    }
}

?>