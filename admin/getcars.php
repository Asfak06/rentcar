<?php
//start session and connect
session_start();
include('../connection.php');

//retrieve all trips
$sql="SELECT * FROM garage";

if($result = mysqli_query($link, $sql)){
    //print_r($result);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if(empty($row['picture'])){
                $picture="picture/noimage.jpg";
            }else{
                $picture=$row['picture'];
            }
            echo 
             '<div class="col-md-4 float-left">
                <div class="card">
                    <img class="card-img-top" data-target="#updatepicture" data-toggle="modal" data-car_id="'.$row['car_id'].'" data-pic="'.$picture.'" src="'.$picture.'" alt="Card image cap">
                   
                  <div class="card-body">
                    <h5 class="card-title form-control">ID : '.$row['car_id'].'</h5>
                    <p class="card-text">
                        <span class="form-control">Category: '.$row['cars'].'</span>
                        <span class="form-control">Brand : '.$row['brand'].'</span>
                        <span class="form-control">Model : '.$row['model'].'</span>
                        <span class="form-control">Capacity : '.$row['capacity'].'</span>
                        <span class="form-control">Status : '.$row['status'].'</span>
                    </p> 
                    <a href="#" class="btn btn-lg border border-dark" data-target="#editcarModal" data-toggle="modal" data-car_id="'.$row['car_id'].'">Edit</a>
                  </div>
                </div>
              </div>
                ';
        }
    }else{
        echo '<div class="notrips alert alert-warning">No cars in garage</div>';
    }
}
?>