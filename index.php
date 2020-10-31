<?php
session_start();
include('connection.php');

include('logout.php');

include('remember.php');
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
 
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBRqdC-FxmYFVhdC1Zc05kQEp6CPC_nPSY&callback=initMap"></script> -->


<!--   <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCwJ 2Vepe9L2Miuh7QH87SR_RItIXHlX6Q"></script> -->

<script src="js/jquery.min.js" ></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<style>
          #results{
            margin-bottom: 100px;   
          }
          .driver{
            font-size:1.5em;
            text-transform:capitalize;
            text-align: center;
          }
          .price{
            font-size:1.5em;
          }
          .departure, .destination{
            font-size:1.5em;
          }
          .perseat{
            font-size:0.5em;
          }
          .journey{
            text-align:left; 
          }
          .journey2{
            text-align:right; 
          }
          .time{
            margin-top:10px;  
          }
          .telephone{
            margin-top:10px;
          }
          .seatsavailable{
            font-size:0.7em; 
            margin-top:5px;
          }
          .moreinfo{
            text-align:left; 
            
          }
          .aboutme{
            border-top:1px solid grey;
            margin-top:15px;
            padding-top:5px;
          }
          #message{
            margin-top:20px;
          }
          .journeysummary{
            text-align:left; 
            font-size:1.5em;
          }
          .noresults{
            text-align:center;  
            font-size:1.5em;
          }
          
          .previewing{
              max-width: 100%;
              height: auto;
              border-radius: 50%;
          }
          .previewing2{
              margin: auto;
              height: 20px;
              border-radius: 50%;
          }
</style>
  </head>

  <body>
<?php

if(isset($_SESSION["user_id"])){
    include("navigationbarconnected.php");
}else{
    include("navigationbarnotconnected.php");
} 

?>
  
<div class="container" id="myContainer">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <h1 class="text-light outline">Plan your next trip here</h1>
        <p class="lead bold text-light">Save Money! Save the Environment!</p>
    
           <form class="from w-50 m-auto" method="get" id="searchform">
              <div class="form-group">
                  <label class="sr-only" for="departure">Departure:</label>
                  <input type="text" class="form-control form-control-sm" id="departure" placeholder="Departure" name="departure">

                  <label class="sr-only"></label>
                  <input type="text" class="form-control form-control-sm" id="destination" placeholder="Destination" name="destination">
              </div>
              <input type="submit" value="Search" class="btn btn-sm btn-success rounded" name="search">
          </form>

      <div id="googleMap"></div>
  <?php
  if(!isset($_SESSION["user_id"])){
    echo'<button class="btn border-dark rounded w-25" data-toggle="modal" data-target="#signupModal">
          <b>Sign up</b>
         </button>';
    }
  ?>

    <div id="results">
    <!--will be filled with Ajax Call-->
    </div>
              
    </div>
  </div>
</div>



<!-- sign up form -->
<form action="post" id="signupForm">
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign Up Here</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="signupmessage"></div>
            <div class="form-group">
              <label for="username" class="sr-only">Username:</label>
              <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
            </div>
            <div class="form-group">
              <label for="firstname" class="sr-only">Firstname:</label>
              <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Firstname" maxlength="30">
            </div>
            <div class="form-group">
              <label for="lastname" class="sr-only">Lastname:</label>
              <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Lastname" maxlength="30">
            </div>
            <div class="form-group">
              <label for="email" class="sr-only">Email:</label>
              <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Choose a password:</label>
              <input class="form-control" type="password" name="password" id="password" placeholder="Choose a password" maxlength="30">
            </div>
            <div class="form-group">
              <label for="password2" class="sr-only">Confirm password</label>
              <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
            </div>
            <div class="form-group">
              <label for="phonenumber" class="sr-only">Telephone:</label>
              <input class="form-control" type="text" name="phonenumber" id="phonenumber" placeholder="Telephone Number" maxlength="15">
            </div>
            <div class="form-group">
              <label><input type="radio" name="gender" id="male" value="male">Male</label>
              <label><input type="radio" name="gender" id="female" value="female">Female</label>
            </div>
            <div class="form-group">
              <label for="moreinformation">Comments: </label>
              <textarea name="moreinformation" class="form-control" rows="5" maxlength="300"></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn border-danger rounded " data-dismiss="modal">Cancel</button>
        <input name="signup" type="submit" value="Sign up" class=" btn border-dark rounded ">
      </div>
    </div>
  </div>
</div>
</form>

<!-- login form -->
<form action="post" id="loginform">
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login Here</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="loginmessage"></div>
        <div class="form-group">
          <label for="loginemail" class="sr-only">Email :</label>
          <input class="form-control" type="email" id="loginemail" name="loginemail" placeholder="Email" maxlength="50">
        </div>
        <div class="form-group">
          <label for="loginpassword" class="sr-only">password :</label>
          <input class="form-control" type="password" id="loginpassword" name="loginpassword" placeholder="password" maxlength="30">
        </div>
        <div class="checkbox">
          <label>
            <input  type="checkbox" name="rememberme" id="rememberme">
            Remember me
          </label>
          <a href="#" data-dismiss="modal" data-target="#forgotpasswardModal" data-toggle="modal" class="float-right">Forgot password?</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="mr-auto btn border-dark rounded " data-dismiss="modal" data-target="#signupModal" data-toggle="modal">Register</button>       
        <input  name="login" type="submit" value="Login" class="btn border-dark rounded ">
      </div>
    </div>
  </div>
</div>
</form>

<!-- Forgot form -->
<form action="post" id="forgotpasswordform">
<div class="modal fade" id="forgotpasswardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot passord? Enter your email address.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="forgotpasswordmessage"></div>
        <div class="form-group">
          <label for="forgotemail" class="sr-only">Email :</label>
          <input class="form-control" type="email" id="forgotemail" name="forgotemail" placeholder="Email" maxlength="50">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="mr-auto btn border-dark rounded " data-dismiss="modal" data-target="#signupModal" data-toggle="modal">Register</button>       
        <input  name="forgotpassward" type="submit" value="Submit" class="btn border-dark rounded ">
      </div>
    </div>
  </div>
</div>
</form>

  <div class="foot bg-dark">
    <div class="container p-3 text-secondary text-justify">
      <p>&copy;orem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio molestiae laudantium nulla et similique, reprehenderit perferendis tempora 2018-<?php $today= date("Y"); echo $today; ?></p>
    </div>
  </div>
<div id="spinner">
 <img src='ajax-loader.gif' width="64" height="64" />
 <br>Loading..
</div>
  </body>


  <script src="js/bootstrap.min.js" ></script>  
  <script src="js/map.js" ></script>  
  <script src="js/index.js" ></script>  


</html>