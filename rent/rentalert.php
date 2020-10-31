<?php
session_start();
include('../connection.php');

if(isset($_SESSION['user_id'])){
  $user_id=$_SESSION['user_id'];
  $car_id=$_POST['car_id'];
  $sql="SELECT * FROM rents WHERE car_id=$car_id ";
  if($result = mysqli_query($link, $sql)){
  	if(mysqli_num_rows($result) > 0){
  		$output='req';
  	}else{
  		$sql2 = "INSERT INTO rents (`user_id`, `car_id`) VALUES ('$user_id','$car_id')";  
  		$results = mysqli_query($link, $sql2);
  		if(!$results){
          $output= '<div class=" alert alert-danger">There was an error! The request could not be added to database!</div>';        
        }else{
           $sql3 = "UPDATE garage SET `status`='on-trip' WHERE `car_id`='$car_id'";    
           $results1 = mysqli_query($link, $sql3);       	
  		   $output='<p>Thanks for renting. We will contact you shortly</p>';
        }
  	}
  }
}else{
	$output='log';
}
echo $output;
?>