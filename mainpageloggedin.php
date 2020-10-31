<?php
session_start();
include('connection.php');
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
?>

<?php
$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_assoc($result); 
    $username = $row['username'];
    if(isset($row['profilepicture'])){
      $picture=$row['profilepicture'];
    }else{
      $picture='';
    }
}else{
    echo "There was an error retrieving the username and email from the database";   
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Car sharing website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styling.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/sunny/jquery-ui.css">

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBRqdC-FxmYFVhdC1Zc05kQEp6CPC_nPSY"></script>

<script src="js/jquery.min.js" ></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<style>

          
        #googleMap{
            width: 300px;
            height: 200px;
            margin: 30px auto;
        }
        .modal{
             margin-top: 40px;
            z-index: 20;   
        }
        .modal-backdrop{
            z-index: 10;        
        }

        .checkbox{
            margin-bottom: 10px;   
        }
        .trip{
            border:1px solid grey;
            border-radius: 10px;
            margin-bottom:10px;
            background: linear-gradient(#ECE9E6, #FFFFFF);
            padding: 10px;
        }
        .price{
            font-size:1.5em;
        }
        .departure, .destination{
            font-size:1.5em;
        } 
        .perseat{
            font-size:0.5em;
    /*        text-align:right;*/
        }
        .time{
            margin-top:10px;  
        }  
        .notrips{
            text-align:center;
        }
        .trips{
            margin-top: 20px;
        }
        
        #mytrips{
          margin-bottom: 100px;   
        }

</style>
</head>

<body>
  
   <nav  role="navigation" class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
     <div class="container-fluid">
         <a href="" class="navbar-brand mb-1 border-bottom border-info text-info">Car Share</a>
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse">
           <span class="navbar-toggler-icon"></span>
         </button>

       <div class="collapse navbar-collapse" id="navbarCollapse">
        
         <ul class="navbar-nav">
           <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>           
           <li class="nav-item"><a class="nav-link" href="rent/rentcar.php">Rent car</a></li>
           <!-- <li class="nav-item"><a class="nav-link" href="#">Request trip</a></li> -->
           <li class="nav-item active"><a class="nav-link" href="mainpageloggedin.php">My trips</a></li>
           <li class="nav-item "><a class="nav-link" href="index.php">Search trips</a></li>
         </ul>

         <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
             <div class="image_preview">
                <?php
                  if(empty($picture)){
                      echo "<img class='preview' src='profilepicture/noimage.jpg' />";
                  }else{
                      echo "<img class='preview' src='$picture' />";
                  }
                ?>
             </div>
             <b><?php echo $username ; ?></b>
            </a>
          </li> 
          <li class="nav-item active text-center"><a class="nav-link border-left border-right border-alert-dark rounded" href="index.php?logout=1">Log out</a></li>
         </ul>
       </div> 
     </div>
   </nav>

<div id="myContainer">
  <!--Container-->
      <div class="container text-left" id="container">
          <div class="row">
            <div class="col-sm-2"></div>
              <div class="col-sm-8">
                  <div>
                      <button type="button" class="btn" data-target="#addtripModal" data-toggle="modal">
                          Add trips
                      </button>

                  </div>
                  <div id="mytrips" class="trips">
                      <!--Ajax Call to php file-->
                  </div>
              </div>

          </div>
      </div>
</div>

<!--Add a trip form-->
<form method="post" id="addtripform">
  <div class="modal fade" id="addtripModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New trip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body">
            
            <!--Error message from PHP file-->
            <div id="result"></div>
            
            <!--Google Map-->
          <div id="googleMap"></div>
            
          <div class="form-group">
              <label for="departure" class="sr-only">Departure:</label>
              <input type="text" name="departure" id="departure" placeholder="Departure" class="form-control">
          </div>
          <div class="form-group">
              <label for="destination" class="sr-only">Destination:</label>
              <input type="text" name="destination" id="destination" placeholder="Destination" class="form-control">
          </div>
          <div class="form-group">
              <label for="price" class="sr-only">Price:</label>
              <input type="number" name="price" id="price" placeholder="Price" class="form-control">
          </div> 
          <div class="form-group">
              <label for="seatsavailable" class="sr-only">Seats available:</label>
              <input type="number" name="seatsavailable" id="seatsavailable" placeholder="Seats available" class="form-control">
          </div>  
          <div  class="form-group">
              <label><input type="radio" name="regular" id="yes" value="Y">Regular</label>    
              <label><input type="radio" name="regular" id="no" value="N">One-off</label>    
          </div>
          <div class="regular checkbox checkbox-inline ">
              <label><input type="checkbox" value="1" id="monday" name="monday"> Monday</label>    
              <label><input type="checkbox" value="1" id="tuesday" name="tuesday"> Tuesday</label>    
              <label><input type="checkbox" value="1" id="wednesday" name="wednesday"> Wednesday</label>    
              <label><input type="checkbox" value="1" id="thursday" name="thursday"> Thursday</label>    
              <label><input type="checkbox" value="1" id="friday" name="friday"> Friday</label>    
              <label><input type="checkbox" value="1" id="saturday" name="saturday"> Saturday</label>    
              <label><input type="checkbox" value="1" id="sunday" name="sunday"> Sunday</label>    
          </div>  
          <div class="oneoff form-group ">
              <label for="date"  class="sr-only">Date: </label>    
              <input name="date" id="date" readonly="readonly" placeholder="Date"  class="form-control">
          </div>  
          <div class="regular oneoff form-group time ">
              <label for="time" class="sr-only">Time: </label>    
              <input type="time" name="time" id="time" placeholder="Time"  class="form-control">
          </div>  
        </div>
        <div class="modal-footer">
          <input class="btn btn-primary" name="createTrip" type="submit" value="Create Trip">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
</div>
</form>
<!--Edit a trip form-->
<form method="post" id="edittripform">
  <div class="modal fade" id="edittripModal" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
               <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit trip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body">
            
            <!--Error message from PHP file-->
            <div id="result2"></div>
            
          <div class="form-group">
              <label for="departure2" class="sr-only">Departure:</label>
              <input type="text" name="departure2" id="departure2" placeholder="Departure" class="form-control">
          </div>
          <div class="form-group">
              <label for="destination2" class="sr-only">Destination:</label>
              <input type="text" name="destination2" id="destination2" placeholder="Destination" class="form-control">
          </div>
          <div class="form-group">
              <label for="price2" class="sr-only">Price:</label>
              <input type="number" name="price2" id="price2" placeholder="Price" class="form-control">
          </div> 
          <div class="form-group">
              <label for="seatsavailable2" class="sr-only">Seats available:</label>
              <input type="number" name="seatsavailable2" placeholder="Seats available" class="form-control" id="seatsavailable2">
          </div>  
        <div  class="form-group">
              <label><input type="radio" name="regular2" id="yes2" value="Y">Regular</label>    
              <label><input type="radio" name="regular2" id="no2" value="N">One-off</label>    
          </div>
          <div class="regular2 checkbox checkbox-inline ">
              <label><input type="checkbox" value="1" id="monday2" name="monday2"> Monday</label>    
              <label><input type="checkbox" value="1" id="tuesday2" name="tuesday2"> Tuesday</label>    
              <label><input type="checkbox" value="1" id="wednesday2" name="wednesday2"> Wednesday</label>    
              <label><input type="checkbox" value="1" id="thursday2" name="thursday2"> Thursday</label>    
              <label><input type="checkbox" value="1" id="friday2" name="friday2"> Friday</label>    
              <label><input type="checkbox" value="1" id="saturday2" name="saturday2"> Saturday</label>    
              <label><input type="checkbox" value="1" id="sunday2" name="sunday2"> Sunday</label>    
          </div>  
          <div class="oneoff2 form-group">
              <input name="date2" id="date2" readonly="readonly" placeholder="Date"  class="form-control">
          </div>  
          <div class="regular2 oneoff2 form-group time">
              <label for="time2" class="sr-only">Time: </label>    
              <input type="time" name="time2" id="time2" placeholder="Time" class="form-control">
          </div>  
        </div>
        <div class="modal-footer">
          <input class="btn btn-primary" name="updatetrip" type="submit" id="updatetrip" value="Edit Trip">
          <input type="button" class="btn btn-danger" name="deletetrip" value="Delete" id="deletetrip">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
</div>
</form>

  <div class="foot bg-dark p-2">
    <div class="container p-3 text-secondary text-justify">
      <p>&copy;orem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio molestiae laudantium nulla et similique, reprehenderit perferendis tempora 2018-<?php $today= date("Y"); echo $today; ?></p>
    </div>
  </div>
  
<!--Spinner-->
<div id="spinner">
 <img src='ajax-loader.gif' width="64" height="64" />
 <br>Loading..
</div>

<script src="js/bootstrap.min.js" ></script>
<script src="js/map.js" ></script>
<script src="js/mytrips.js" ></script>

</body>

  </html>