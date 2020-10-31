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
//Get inputs:

$car_id = $_POST["car_id"];
$brand = $_POST["brand2"];
$model = $_POST["model2"];
$capacity = $_POST["capacity2"];

if(!isset($_POST["cars2"])){
    $cars ="";
}else{
    $cars =$_POST["cars2"];
}

if(!isset($_POST["status2"])){
    $status ="";
}else{
    $status =$_POST["status2"];
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

//if there is an error print error message
if($errors){
    $resultMessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultMessage;
}else{
    //no errors, prepare variables for the query
    $tbl_name = 'garage';

        $sql = "UPDATE $tbl_name SET `cars`= '$cars',`brand`='$brand',`model`='$model', `capacity`='$capacity',`status`='$status' WHERE `car_id`='$car_id'";    

    $results = mysqli_query($link, $sql);
    //check if query is successful
    if(!$results){
        echo '<div class=" alert alert-danger">There was an error! The trip could not be updated!</div>';        
    }
}

?>