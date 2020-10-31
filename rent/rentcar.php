<?php
session_start();
include('../logout.php');
include('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car sharing website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/pepper-grinder/jquery-ui.css">

<script src="../js/jquery.min.js" ></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<style>

body{
  background-color: #2c3e50;
}
#myContainer {
  margin-top:15vh;
  min-height:85vh;
  height: auto;
  text-align: center;
  color: black;
}
.tabs{
  width: 80%;
  margin: 100px auto;
}
.tabs ul {
display: flex;
flex-direction:row;
justify-content: center;
}
.foot{
  height: auto;
  min-height:100px;
}
.preview{
  height: 30px;
 border-radius:50%;
}
.image_preview{
  float: left;
  margin-right:10px;
  margin-top:-2px;
}
.notrips{
  text-align:center;
}
.card{
  min-width:300px;
}
.outline{
  margin-bottom: -50px;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
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
  
<div id="myContainer">  
  <h1 class="text-light outline">Rent a car from our garage</h1>
  <div class="tabs text-justify">
    <ul>
      <li><a href="#aaa">Priavte car</a></li>
      <li><a href="#bbb">Pick-up van</a></li>
      <li><a href="#ccc">Truck</a></li>
    </ul>

    <div class="row">
      <div id="aaa">

      </div>
    </div>

    <div class="row">
      <div id="bbb">

      </div>
    </div>

    <div class="row">
      <div id="ccc">

      </div>
    </div>
 
  </div>
</div>

  <div class="foot bg-dark">
    <div class="container p-3 text-secondary text-justify">
      <p>&copy;orem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio molestiae laudantium nulla et similique, reprehenderit perferendis tempora 2018-<?php $today= date("Y"); echo $today; ?></p>
    </div>
  </div>

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


  <div class="modal fade" id="alert" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">       
            <div class="text-center" id="alertmessage">
              <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus.</p>
            </div>     
        </div>
      </div>
     </div>
  </div>



</body>

<script src="../js/bootstrap.min.js" ></script>  
<script>
getPrivate();
getVan();
getTruck();

$(document).ready(function(){
  $('.tabs').tabs();
});



function getPrivate(){
  $.ajax({
        url: "private.php",
        success: function(data){
             $("#aaa").html(data);          
        },
        error: function(){
            $("#aaa").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>"); 
        }
    });
}
function getVan(){
  $.ajax({
        url: "van.php",
        success: function(data){
             $("#bbb").html(data);          
        },
        error: function(){
            $("#bbb").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>"); 
        }
    });
}

function getTruck(){
  $.ajax({
        url: "truck.php",
        success: function(data){
             $("#ccc").html(data);          
        },
        error: function(){
            $("#ccc").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>"); 
        }
    });
}

var id;
$('#alert').on('show.bs.modal', function (e) {
    var invoker = $(e.relatedTarget);
    id=invoker.data('car_id');
    rentalert();
});

 function rentalert(){
      $.ajax({
            url: "rentalert.php",
            method: "POST",
            data: {car_id:id},
            success: function(response){

              if(response=='log'){
                $('#alertmessage').html('<p>You must log in first</p>');
              }else if (response=='req') {
                $('#alertmessage').html('<p>This car is currently unavailable</p>');  
              }else{
                $('#alertmessage').html(response);
                getPrivate();
                getVan();
                getTruck();
              }
              
            },
            error: function(){
               $('#alertmessage').html('<p>something went wrong</p>');
            }
        
    });
 }


$("#loginform").submit(function(event){ 
    event.preventDefault();
    var datatopost = $(this).serializeArray();
    $.ajax({
        url: "../login.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data == "success"){
                window.location = "../mainpageloggedin.php";
            }else{
                $('#loginmessage').html(data);   
            }
        },
        error: function(){
            $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>"); 
        }
    });
});
</script>
</html>