<?php
session_start();
if(!isset($_SESSION['pass'])){
    header("location: index.php");
}
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

.foot{
  height: auto;
  min-height:100px;
}
.del{
  cursor:pointer;
}
</style>
</head>
<body>

<nav  role="navigation" class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
  <div class="container-fluid">
    <a href="" class="navbar-brand mb-1 border-bottom border-info text-info"><b>Car Share</b></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="">Rents</a></li>
        <li class="nav-item "><a class="nav-link" href="panel.php">Garage</a></li>
      </ul>
      <ul class="navbar-nav ml-auto">
          <li class="nav-item active text-center"><a class="nav-link border-left border-right border-alert-dark rounded" href="index.php?logout=1">Log out</a></li>
      </ul>
    </div>
  </div>
</nav>

 <div id="myContainer">


 </div>

<div class="foot bg-dark">
<div class="container p-3 text-secondary text-justify">
  <p>&copy;orem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio molestiae laudantium nulla et similique, reprehenderit perferendis tempora 2018-<?php $today= date("Y"); echo $today; ?></p>
</div>
</div>


  <div class="modal fade" id="delalert" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">       
            <div class="text-center" id="alertmessage">
              <p class="lead">are you sure?</p>
            </div>     
        </div>
        <div class="modal-footer">
          <input id="delete" class="btn green" type="submit" value="delete">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cancel
          </button> 
        </div>
      </div>
     </div>
  </div>

</body>
  <script src="../js/bootstrap.min.js" ></script> 

<script>
getRent();

setInterval(getRent, 3000);

function getRent(){
  $.ajax({
      url: "getrents.php",
      success: function(data){
            $('#myContainer').html(data);
          },
      error: function(){
            $('#myContainer').html('<p>Something went wrong!</p>');
          }
  }); 

}

var user_id;
var car_id;

$('#delalert').on('show.bs.modal', function (e) {
    var invoker = $(e.relatedTarget);
    car_id=invoker.data('car_id');
    user_id=invoker.data('user_id');

    $('#delete').click(function(){
          delrent();
    })

});


function delrent(){
    $.ajax({
    url: "deleterents.php",
    method: "POST",
    data: {car_id:car_id,user_id:user_id},
    success: function(data){
      $('#delalert').modal('hide');
      getRent();
    },
    error: function(){
      alert('something went wrong');
    }
  });
}



</script>

</html>