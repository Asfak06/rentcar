<?php
session_start();
include('logout.php');

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
<script src="../js/jquery.min.js" ></script>  
<style>
#myContainer {
  min-height:85vh;
  height: auto;
  text-align: center;
  color: black;
  display:flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.foot{
  height: auto;
  min-height:100px;
}
</style>
</head>
<body>
  <div id="myContainer">
    
    <div class="form-group">
    <div class="message text-center text-danger"></div>
    <input id="pass" class="form-control" type="password" placeholder="password">
    <button id="passbtn" class="btn btn-info form-control" ><strong>Enter</strong></button>
    </div>
  </div>
  <div class="foot bg-dark">
    <div class="container p-3 text-secondary text-justify">
      <p>&copy;orem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio molestiae laudantium nulla et similique, reprehenderit perferendis tempora 2018-<?php $today= date("Y"); echo $today; ?></p>
    </div>
  </div>
</body>
  <script src="../js/bootstrap.min.js" ></script>  
  <script>
    $(document).ready(function(){
      $('#passbtn').click(function(event){
        var pass=$('#pass').val();
          $.ajax({
              url: "login.php",
              type: "POST",
              data: {pass:pass},
              success: function(data){
                  if(data == "success"){
                      window.location = "panel.php";
                  }else{
                    $('.message').html('<p><strong>wrong password</strong></p>');   
                  }
              },
              error: function(){
                  $(".message").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");                  
              }
          });
      })
    });
  </script>
</html>