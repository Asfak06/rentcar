<?php
session_start();
include('../connection.php');
$sql="SELECT * FROM garage WHERE cars='Private-car' AND status='available' ";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
    	while($row = mysqli_fetch_assoc($result)){
            if(empty($row['picture'])){
                $picture="../admin/picture/noimage.jpg";
            }else{
                $picture=$row['picture'];
                $picture="../admin/$picture";
            }
            echo 
             '<div class="col-md-4 float-left">
             	<div class="card">
                    <img class="card-img-top" src="'.$picture.'" alt="Card image cap">
                   
                  <div class="card-body">
                    <h5 class="card-title form-control">ID : '.$row['car_id'].'</h5>
                    <p class="card-text">
                        <span class="form-control">Category: '.$row['cars'].'</span>
                        <span class="form-control">Brand : '.$row['brand'].'</span>
                        <span class="form-control">Model : '.$row['model'].'</span>
                        <span class="form-control">Capacity : '.$row['capacity'].'</span>         
                    </p> 
                  </div>
                  <div class="card-footer">
                       <button class="rent btn btn-lg border border-dark" data-target="#alert" data-toggle="modal" data-car_id="'.$row['car_id'].'">Rent</button>            	
                  </div>
                </div>
             </div>';

        }
    }else{
    	echo '<div class="notrips alert alert-warning">No private cars in garage now.</div>';
    }
}

?>