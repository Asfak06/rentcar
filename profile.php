
<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');

$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_assoc($result); 
    $username = $row['username'];
    $email = $row['email']; 
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
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styling.css">

<script src="js/jquery.min.js" ></script>  

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
           <li class="nav-item active"><a class="nav-link" href="profile.php">Profile</a></li>           
           <li class="nav-item"><a class="nav-link" href="rent/rentcar.php">Rent car</a></li>
           <!-- <li class="nav-item"><a class="nav-link" href="#">Request trip</a></li> -->
           <li class="nav-item "><a class="nav-link" href="mainpageloggedin.php">My trips</a></li>
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

<div class="container" id="myContainer">
	<div class="row">
		<div class="col-md-3"></div>
		<div class=" col-md-6 mt-5">
			<h2 class="text-light">Profile details</h2>
			<div class="table-responsive text-light">
				<table class="table table-hover table-bordered mt-3">
					<tr >
						<td>User name</td>
						<td><?php echo $username; ?></td>
						<td class="text-center">
							<a class="badge badge-info badge-pill"href="#updateusername" data-toggle="modal">Update</a>	
						</td>
					</tr>
					<tr >
						<td>Email</td>
						<td><?php echo $email ?></td>
						<td class="text-center">
							<a class="badge badge-info badge-pill"href="#updateemail" data-toggle="modal">Update</a>	
						</td>
					</tr>
					<tr >
						<td>Password</td>
						<td>hidden</td>
						<td class="text-center">
							<a class="badge badge-info badge-pill"href="#updatepassword" data-toggle="modal">Update</a>
						</td>				
					</tr>
          <tr >
            <td>Picture</td>
            <td>
                <div class="">
                  <?php
                  if(empty($picture)){
                      echo "<img class='preview' src='profilepicture/noimage.jpg' />";
                  }else{
                      echo "<img class='preview' src='$picture' />";
                  }
                  ?>      
                </div>
            </td>
            <td class="text-center">
              <a class="badge badge-info badge-pill"href="#updatepicture" data-toggle="modal">Update</a>
            </td>       
          </tr>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Update name -->
<form action="post" id="updateusernameform">
<div class="modal fade" id="updateusername" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Username</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="updateusernamemessage"></div>
        <div class="form-group">
          <label for="username" class="sr-only">update user name :</label>
          <input class="form-control" type="text" id="username" name="username"  maxlength="50" value="<?php echo $username; ?>">
        </div>
      </div>
      <div class="modal-footer">     
        <input  name="updateusername" type="submit" value="Update" class="btn border-dark rounded ">
      </div>
    </div>
  </div>
</div>
</form>

<!-- Update email -->
<form action="post" id="updateemailform">
<div class="modal fade" id="updateemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="updateemailmessage"></div>
        <div class="form-group">
          <label for="email" class="sr-only">update email :</label>
          <input class="form-control" type="email" id="email" name="email"  maxlength="50" value="<?php echo $email ?>">
        </div>
      </div>
      <div class="modal-footer">     
        <input  name="updateemail" type="submit" value="Update" class="btn border-dark rounded ">
      </div>
    </div>
  </div>
</div>
</form>

<!-- Update password -->
<form action="post" id="updatepasswordform">
<div class="modal fade" id="updatepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="updatepasswordmessage"></div>
        <div class="form-group">
          <label for="currentpassword" class="sr-only">current password :</label>
          <input class="form-control" type="password" id="currentpassword" name="currentpassword"  maxlength="50" placeholder="your current password">
        </div>
        <div class="form-group">
          <label for="password" class="sr-only">choose a password :</label>
          <input class="form-control" type="password" id="password" name="password"  maxlength="50" placeholder="choose a password ">
        </div>
        <div class="form-group">
          <label for="password2" class="sr-only">confirm password :</label>
          <input class="form-control" type="password" id="password2" name="password2"  maxlength="50" placeholder="confirm password">
        </div>       
      </div>
      <div class="modal-footer">     
        <input  name="updatepassword" type="submit" value="Update" class="btn border-dark rounded ">
      </div>
    </div>
  </div>
</div>
</form>

      <!--Update picture-->    
      <form method="post" enctype="multipart/form-data" id="updatepictureform">
        <div class="modal fade" id="updatepicture" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">       
                  <!--Update picture message from PHP file-->
                  <div id="updatepicturemessage"></div>
                  <?php
                    if(empty($picture)){
                        echo "<div class=''><img id='previewing' src='profilepicture/noimage.jpg' /></div>";
                    }else{
                        echo "<div class=''><img id='previewing' src='$picture' /></div>";
                    }
    
                  ?>
                  <div class="form-inline">
                      <div class="form-group">
                        <label for="picture">Select a picture:</label>
                        <input type="file" name="picture" id="picture">
                      </div>
                  </div>         
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="updatepicture" type="submit" value="Submit">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button> 
              </div>
          </div>
      </div>
      </div>
      </form>

<!-- footer -->
  <div class="foot bg-dark p-2">
    <div class="container p-3 text-secondary text-justify">
      <p>&copy;orem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio molestiae laudantium nulla et similique, reprehenderit perferendis tempora 2018-<?php $today= date("Y"); echo $today; ?></p>
    </div>
  </div>

  </body>
  <script src="js/bootstrap.min.js" ></script>  
  <script src="js/profile.js" ></script>  
</html>