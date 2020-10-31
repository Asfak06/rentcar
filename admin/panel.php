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
#myContainer {
  min-height:85vh;
  height: auto;
  text-align: center;
  color: black;
}
#container{
	margin-top:80px;
}
.foot{
  height: auto;
  min-height:100px;
}
#spinner{
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    height: 85px;
    text-align: center;
    margin: auto;
    z-index: 1100;
}
.card{
	min-width:300px;
}
.card-img-top{
  cursor:pointer;
}
#previewing{
    max-width: 100%;
    height: auto;
    border-radius: 50%;
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
        <li class="nav-item"><a class="nav-link" href="rents.php">Rents</a></li>
        <li class="nav-item active"><a class="nav-link" href="">Garage</a></li>
      </ul>
      <ul class="navbar-nav ml-auto">
          <li class="nav-item active text-center"><a class="nav-link border-left border-right border-alert-dark rounded" href="index.php?logout=1">Log out</a></li>
      </ul>
    </div>
  </div>
</nav>

 <div id="myContainer">

  <div class="container text-left" id="container">
              
              <div class="mb-3">
                  <button type="button" class="btn border border-dark" data-target="#addcarModal" data-toggle="modal">
                      Add cars
                  </button>
                  <input type="number" class="form-control w-50 float-right" id="search" placeholder="Search By ID" >
              </div>
              
              <div class="row">
              		<div id="mycars" class="mb-3">

              		</div>
              </div>
  </div>

 </div>
 <form method="post" id="addcarform">
  <div class="modal fade" id="addcarModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body"> 
            <!--Error message from PHP file-->
          <div id="result"></div>
          <div class="form-group">
			  <select class="form-control" id="cars" name="cars">
			    <option value="">Choose Category</option>
			    <option value="Private-car">Private-car</option>
			    <option value="Pick-up van">Pick-up van</option>
			    <option value="Truck">Truck</option>
			  </select>  	
          </div>

          <div class="form-group">
              <label for="brand" class="sr-only">Car Brand:</label>
              <input type="text" name="brand" id="brand" placeholder="Car brand" class="form-control">
          </div>
          <div class="form-group">
              <label for="model" class="sr-only">Model:</label>
              <input type="text" name="model" id="model" placeholder="Car Model" class="form-control">
          </div>

          <div class="form-group">
              <label for="capacity" class="sr-only">Seats:</label>
              <input type="text" name="capacity" id="capacity" placeholder="Capacity" class="form-control">
          </div>  
          <div  class="form-group">
              <label><input type="radio" name="status" id="yes" value="available">Available</label>    
              <label><input type="radio" name="status" id="no" value="on-trip">On-trip</label>    
          </div>
        </div>
        <div class="modal-footer">
          <input class="btn btn-primary" name="addcar" type="submit" value="Add">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
</div>
</form>

<form method="post" id="editcarform">
  <div class="modal fade" id="editcarModal" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
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
			  <select class="form-control" id="cars2" name="cars2">
			    <option value="">Choose Category</option>
			    <option value="Private-car">Private-car</option>
			    <option value="Pick-up van">Pick-up van</option>
			    <option value="Truck">Truck</option>
			  </select>  	
          </div>

          <div class="form-group">
              <label for="brand2" class="sr-only">Car Brand:</label>
              <input type="text" name="brand2" id="brand2" placeholder="Car brand" class="form-control">
          </div>
          <div class="form-group">
              <label for="model2" class="sr-only">Model:</label>
              <input type="text" name="model2" id="model2" placeholder="Car Model" class="form-control">
          </div>

          <div class="form-group">
              <label for="capacity2" class="sr-only">Seats:</label>
              <input type="text" name="capacity2" id="capacity2" placeholder="Capacity" class="form-control">
          </div>  
          <div  class="form-group">
              <label><input type="radio" name="status2" id="yes2" value="available">Available</label>    
              <label><input type="radio" name="status2" id="no2" value="on-trip">On-trip</label>    
          </div>
        </div> 
        
        <div class="modal-footer">
          <input class="btn btn-primary" name="updatecar" type="submit" id="updatecar" value="Edit Car">
          <input type="button" class="btn btn-danger" name="deletecar" value="Delete" id="deletecar">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

              <div class=''>
                <img id='previewing'  src="">
              </div>

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

<div class="foot bg-dark">
<div class="container p-3 text-secondary text-justify">
  <p>&copy;orem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio molestiae laudantium nulla et similique, reprehenderit perferendis tempora 2018-<?php $today= date("Y"); echo $today; ?></p>
</div>
</div>
<!--Spinner-->
<div id="spinner">
 <img src='ajax-loader.gif' width="64" height="64" />
 <br>Loading..
</div>

</body>
  <script src="../js/bootstrap.min.js" ></script>  
  <script>
   var data;
   
getCars();
// update picture code 
var file;
var id;
$('#updatepicture').on('show.bs.modal', function (e) {
    var invoker = $(e.relatedTarget);
    id=invoker.data('car_id');
    var addr=invoker.data('pic');
    $('#previewing').attr('src',addr);
});

$("#updatepictureform").submit(function(event) {
    //hide message
    $("#updatepicturemessage").hide();
    //show spinner
    $("#spinner").css("display", "block");
    event.preventDefault();
    if(!file){
        $("#spinner").css("display", "none");
        $("#updatepicturemessage").html('<div class="alert alert-danger">Please upload a picture!</div>');
            $("#updatepicturemessage").slideDown();
        return false;
    }
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg"];
        if($.inArray(imagefile, match) == -1){
            $("#updatepicturemessage").html('<div class="alert alert-danger">Wrong File Format</div>');
            $("#updatepicturemessage").slideDown();
            $("#spinner").css("display", "none");
            return false;
        }else{
          var imgdata=new FormData(this);
          imgdata.append('car_id', id);
            $.ajax({
                url: "updatepicture.php", 
                type: "POST",             
                data:imgdata, 
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data){
                    if(data){
                        $("#updatepicturemessage").html(data);
                        //hide spinner
                        $("#spinner").css("display", "none");
                        //show message
                        $("#updatepicturemessage").slideDown();
                        //update picture in the settings
                    }else{
                        location.reload();
                    }

                },
                error: function(){
                    $("#updatepicturemessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                    //hide spinner
                    $("#spinner").css("display", "none");
                    //show message
                    $("#signupmessage").slideDown();

                }
            });
        }

});

// Function to preview image after validation
$(document).ready(function() {
$("#picture").change(function() {
$("#updatepicturemessage").empty();
file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
    if($.inArray(imagefile, match) == -1){
        $("#updatepicturemessage").html("<div class='alert alert-danger'>Wrong file format!</div>");
        return false;
    }
    else{
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[0]);
    }
});
});
function imageIsLoaded(event) {
    $('#previewing').attr('src', event.target.result);
};



    $('#addcarform').submit(function(event){
            $("#result").hide();
            $("#spinner").css("display", "block");
            event.preventDefault();
            data = $('#addcarform').serializeArray();
            submitAddCarRequest();
    });


function submitAddCarRequest(){
        $.ajax({
            url: "addcars.php",
            data: data,
            type: "POST",
            success: function(data2){
                if(data2){
                    $('#result').html(data2);
                    $("#spinner").css("display", "none");
                    $("#result").slideDown();
                }else{
                    getCars();
                    $("#result").hide();
                    $('#addcarModal').modal('hide');
                    $("#spinner").css("display", "none");
                    //empty form
                    $('#addcarform')[0].reset();
                }
            },
            error: function(){
                $("#result").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                $("#spinner").css("display", "none");
                $("#result").fadeIn();

            }
        }); 
}

$('#editcarModal').on('show.bs.modal', function (e) {
    $('#result2').html("");
    var $invoker = $(e.relatedTarget);
    $.ajax({
            url: "getcardetails.php",
            method: "POST",
            data: {car_id:$invoker.data('car_id')},
            success: function(data2){
                car = JSON.parse(data2);
                //fill edit trip form inputs using AJAX returned JSON data
                formatModal();
        },
            error: function(){
                $('#result2').html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                $('#result2').hide();
                $('#result2').fadeIn();
    
            }
        
    });
    
    //setup delete button for AJAX Call
    $('#deletecar').click(function(){
    	deleteCar($invoker);
    });
    
    // Click on Edit Trip Button
    $('#editcarform').submit(function(event){
        $("#result2").hide();
        $("#spinner").css("display", "block");
        event.preventDefault();
        data = $('#editcarform').serializeArray();
        data.push({name: 'car_id', value: $invoker.data('car_id')});
        submitEditCarRequest();
    });
    
});

function deleteCar($invoker){
$.ajax({
	url: "deletecars.php",
	method: "POST",
	data: {car_id:$invoker.data('car_id')},
	success: function(){
	    $('#editcarModal').modal('hide');
	    getCars();
	},
	error: function(){
	    $('#result2').html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
	    $('#result2').hide();
	    $('#result2').fadeIn();
	}

});
}
function formatModal(){
    $('#cars2').val(car["cars"]);    
    $('#brand2').val(car["brand"]); 
    $('#model2').val(car["model"]);    
    $('#capacity2').val(car["capacity"]);    
    if(car["status"] == "available"){
        $('#yes2').prop('checked', true);       
    }else{
        $('#no2').prop('checked', true);
    };
}

function submitEditCarRequest(){
	$.ajax({
	    url: "updatecars.php",
	    data: data,
	    type: "POST",
	    success: function(data2){
	        if(data2){
	            $('#result2').html(data2);
	            $("#spinner").css("display", "none");
	            $("#result2").slideDown();
	        }else{
	            getCars();
	            $("#result2").hide();
	            $('#editcarModal').modal('hide');
	            $("#spinner").css("display", "none");
	            //empty form
	            $('#editcarform')[0].reset();
	        }
	    },
	    error: function(){
	        $("#result2").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
	        $("#spinner").css("display", "none");
	        $("#result2").fadeIn();

	    }
	}); 
}

function getCars(){
	$("#spinner").css("display", "block");
	$.ajax({
	    url: "getcars.php",
	    success: function(data2){
	        $("#spinner").css("display", "none");
	        $('#mycars').html(data2);
	        $('#mycars').hide();
	        $('#mycars').fadeIn();
	        },
	    error: function(){
	        $("#spinner").css("display", "none");
	        $('#mycars').html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
	        $('#mycars').hide();
	        $('#mycars').fadeIn();
	        }
	}); 
}



          $('#search').keyup(function(){
            var text=$('#search').val();
            if (text != ''){
              $.ajax({
                url:"search.php",
                type:"post",
                data:{text:text},
                success: function(data2){
                    $("#spinner").css("display", "none");
                    $('#mycars').html(data2);
                    $('#mycars').hide();
                    $('#mycars').fadeIn();
                    },
                error: function(){
                    $("#spinner").css("display", "none");
                    $('#mycars').html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                    $('#mycars').hide();
                    $('#mycars').fadeIn();
                    }

              })
            }
          });


  </script>
</html>