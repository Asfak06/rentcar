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
           <!-- <li class="nav-item"><a class="nav-link" href="#">Request trip</a></li> -->s
           <li class="nav-item "><a class="nav-link" href="mainpageloggedin.php">My trips</a></li>
           <li class="nav-item active"><a class="nav-link" href="index.php">Search trips</a></li>
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