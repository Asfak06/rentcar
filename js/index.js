//create a geocoder object to use the geocode
var geocoder = new google.maps.Geocoder();
var data;


$("#signupForm").submit(function(event){
 event.preventDefault();
 var datatopost=$(this).serializeArray();
 $.ajax({
 url:"signup.php",
 type:"POST",
 data:datatopost,
 success:function(data){
  if(data){
    $("#signupmessage").html(data); 
  }
 },
 error:function(){
  $("#signupmessage").html("<div class='alert alert-danger'>There was an error with Ajax call. Please try again later.</div>");
 }
 });
});

//Ajax Call for the login form
//Once the form is submitted

$("#loginform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to login.php using AJAX
    $.ajax({
        url: "login.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data == "success"){
                window.location = "mainpageloggedin.php";
            }else{
                $('#loginmessage').html(data);   
            }
        },
        error: function(){
            $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});

//Ajax Call for the forgot password form
//Once the form is submitted
$("#forgotpasswordform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "forgot-password.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            
            $('#forgotpasswordmessage').html(data);
        },
        error: function(){
            $("#forgotpasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});


//Ajax Call for the search form 
$("#searchform").submit(function(event){
    $("#results").fadeOut();
    $("#spinner").css("display", "block");
    event.preventDefault();
    data = $(this).serializeArray();
    console.log(data);
    
    
    getSearchTripDepartureCoordinates();
    
});
                        
//define functions
function getSearchTripDepartureCoordinates(){
                // data.push({name:'departureLongitude', value: 23.81});
                // data.push({name:'departureLatitude', value: 80.4});
                // getSearchTripDestinationCoordinates();
    geocoder.geocode(
        {
            'address' : document.getElementById("departure").value
        },
        function(results, status){
            if(status == google.maps.GeocoderStatus.OK){
                departureLongitude = results[0].geometry.location.lng();
                departureLatitude = results[0].geometry.location.lat();
                data.push({name:'departureLongitude', value: departureLongitude});
                data.push({name:'departureLatitude', value: departureLatitude});
                getSearchTripDestinationCoordinates();
            }else{
                getSearchTripDestinationCoordinates();
            }

        }
    );
}

function getSearchTripDestinationCoordinates(){
                // data.push({name:'destinationLongitude', value: 22.8});
                // data.push({name:'destinationLatitude', value: 80.5});
                // submitSearchTripRequest();
    geocoder.geocode(
        {
            'address' : document.getElementById("destination").value
        },
        function(results, status){
            if(status == google.maps.GeocoderStatus.OK){
                destinationLongitude = results[0].geometry.location.lng();
                destinationLatitude = results[0].geometry.location.lat();
                data.push({name:'destinationLongitude', value: destinationLongitude});
                data.push({name:'destinationLatitude', value: destinationLatitude});
                submitSearchTripRequest();
            }else{
                submitSearchTripRequest();
            }

        }
    );

}

function submitSearchTripRequest(){
    console.log(data);
    $.ajax({
        url: "search.php",
        data: data,
        type: "POST",
        success: function(data2){
            console.log(data);
            if(data2){
                $('#results').html(data2);
                //accordion
                $("#message").accordion({
                    icons: false,
                    active:false,
                    collapsible: true,
                    heightStyle: "content"   
                });
            }
            $("#spinner").css("display", "none");
            $("#results").fadeIn();
    },
        error: function(){
            $("#results").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            $("#spinner").css("display", "none");
            $("#results").fadeIn();

}
    }); 

}  
