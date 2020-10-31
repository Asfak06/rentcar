<?php

session_start();
include('../connection.php');


$sql="SELECT * FROM rents";
$output='';
if($result = mysqli_query($link, $sql)){

    if(mysqli_num_rows($result) > 0){
    	$output.='<div class="row">
				    <div class="col-md-3"></div>
				    <div class=" col-md-6">
				      <h2 class="text-light">Rents</h2>
				      <div class="table-responsive text-light">
				        <table class="table table-hover table-bordered mt-3">
				          <tr>
				            <td>Rent ID</td>
				            <td>Car ID</td>
				            <td>User ID</td>
				            <td>User Contact</td>
				          </tr>';

        while($row = mysqli_fetch_assoc($result)){
        	$user_id=$row['user_id'];
        	$sql2="SELECT * FROM users WHERE user_id=$user_id";
        	$result2 = mysqli_query($link, $sql2);
        	$row2 = mysqli_fetch_assoc($result2);
        	$contact=$row2['phonenumber'];
        	$output.='<tr >
			            <td>'.$row['rent_id'].'</td>
			            <td>'.$row['car_id'].'</td>
			            <td>'.$row['user_id'].'</td>
			            <td>'.$contact.'</td>
			            <td class="text-center">
			              <span class="del badge badge-info badge-pill" data-target="#delalert" data-toggle="modal" data-car_id="'.$row['car_id'].'" data-user_id="'.$row['user_id'].'">delete</span>  
			            </td>
			          </tr>';
        }
    }else{
       $output.= '<div class="alert alert-warning">No rents yet</div>';
    }
    $output.='</table>
	      </div>
	    </div>
	  </div>';
}

echo $output;
?>