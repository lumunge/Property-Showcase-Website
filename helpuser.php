<?php
error_reporting(E_ERROR||E_PERSER);
session_start();
include("assets/connection.php");
// include('assets/pageNav.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">



<title>Help</title>

<link href="css/adminNav.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="./FAICO/css/all.min.css"/>
<style>
  .home a{
    position: absolute;
    top: 2rem;
    left: 2rem;
    font-size: 5rem;
    /* background-color: #696969; */
    color: #696969;
  }
  .home a:hover{
    color: #FF6347;
    transition: all .7s ease-in-out;
  }
  .home p{
    position: absolute;
    top: 7.3rem;
     left: 0.6rem;
    text-align: center;
    font-size: 1.2rem;
    color: yellow;
  }
</style>
</head>

<body>
<!-- container section start -->
<section id="container" class="">
<div class="home">
<a href="index.php"><i class="fas fa-home"></i>  </a>
<p><i class="fas fa-arrow-left"></i> Back Home</p>
</div>
<!--main content start-->
<section id="" style="margin: 50px; padding: 30px; background-color: #333; color: #fff;">               
<h2>  <em>Your Help is Here</em></h2>
<h3>How to register</h3>
<ul>
<li>   In  the home page click on the register link.
</li>
<li>   a page will appear where you will presenbe ted with a form. use this form to fill in the required details.
</li>
<li>  in the form enter a unique username and password </li>
<li> after filling all the details click on the create account button.   </li>
<li>   if no error was made when filling the form your account will be created and you will be presented with a login form.
</li>
<li>   </li>
<li>   </li>
</ul>
<h3> how to login</h3>
<ul>
<li>      click on the login lick in the home page.
</il>
<li>      a page will appear where you will be required to enter your collect username and password to be able to login
</il>
<li>      if login was successful you will be directed to your profile.</il>
</ul>
<h3>  update profile Account
</h3>
<ul>
<li>    login using your username and password 
</li>
<li>    in your profile account click on the update tab 
</li>
<li>    a form will appear where you will be presented with a form. 
</li>
<li>    use this form to edit the details that you want and click on the update button
</li>
<li>    if no error are a made your account will be updated successfully 
</li>
</ul>
<h3>   how to book a room
</h3>
<ul>
<li>    click on the home link or the book apartment button in your profile page.
</li>
<li>    you will be presented with county apartment.  click on the book button of your desired apartment. 
</li>
<li>    in the next page the tappers you will be present with rooms that are available for booking.
</li>
<li>    Click on the book button to add the room number to you booking cart.</li>
<li>    you can book more than one room.
</li>
<li>   to remove a room from the booking cart click on the remove button.</li>
<li>   when you are done click on the checkout button. 
</li>
<li>   in the checkout page click on the book button and will be presented with popup form where you will be required to enter the collect mpesa code and the amount required to complete the booking process.
</li>
</ul>
<h3> how to view my booking status </h3>
<ul>
<li>    login to your account </li>
<li>    in your profile account click on the booking status tab.</li>
<li>    here you will be able to view the status of your booking.<li>
</ul>
<h3>   how to pay rent </h3>
<ul>
<li>  in your profile account click on the pay rent link
</li>
<li>   in the page that appear select the room that you want to pay rent for 
you will be presented with a form. enter the mpesa code and rent.
</li>
<li>   click on the pay rent button to submit your payment.
</li>
<li>   to view your rent payment status click on the payment history tab.
</li>
</ul>
<h3>How to vacate a room</h3>
<ul>
<li> in your profile account click on the  vacate room link </li>
<li> in the page that appear select the room that want to vacate by clicking on the select button </li>
<li>You will be presented with a form. use this form to enter the date that you desire to vacated </li>
<li>click on the submit button to complete the processs </li>
<li>  If your vacate notice has been received. you will be present with a view detail button where you can the status of your notice </li>
</ul>
<h3>How to pay A fine </h3>
<ul>
<li> Click on the detail button in the vacate page  </li>
<li>  In the page that appear click on the pay fine button. you will be presented with a form where you will enter the mpesa code and fine amount  </li>
<li> Wait for the admin to approve your fine . </li>
<li>  After fine payment has been approved you will be presented with a button that you will click to be presented with a popup to confirm your that u want to vacate</li>
<li>To check on the refund status click on the refund button.   </li>
</ul>





<div class="row"></div>  


<!-- Today status end -->



<div class="row"><!--/col--><!--/col--><!--/col-->

</div>



<!-- statics end -->




<!-- project team & activity start -->
<div class="row"></div><br><br>

<div class="row"></div> 
<!-- project team & activity end -->

</section>
<div class="text-right">

</div>
</section>
<!--main content end-->
</section>
<!-- container section start -->


<script>

//knob
$(function() {
$(".knob").knob({
'draw' : function () { 
$(this.i).val(this.cv + '%')
}
})
});

//carousel
$(document).ready(function() {
$("#owl-slider").owlCarousel({
navigation : true,
slideSpeed : 300,
paginationSpeed : 400,
singleItem : true

});
});

//custom select box

$(function(){
$('select.styled').customSelect();
});

/* ---------- Map ---------- */
$(function(){
$('#map').vectorMap({
map: 'world_mill_en',
series: {
regions: [{
values: gdpData,
scale: ['#000', '#000'],
normalizeFunction: 'polynomial'
}]
},
backgroundColor: '#eef3f7',
onLabelShow: function(e, el, code){
el.html(el.html()+' (GDP - '+gdpData[code]+')');
}
});
});

</script>
<script src="./FAICO/js/all.min.js"></script>
</body>
</html>
