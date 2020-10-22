<?php
error_reporting(E_ERROR||E_PERSER);
session_start();
include("../assets/connection.php");
include("../assets/finalAdmin.php");







?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title>Help</title>

    <link href="../css/adminNav.css" rel="stylesheet">
   <!---<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>----->
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../css/bootstrap.css">

<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/sweetalert.css">


<script src="../js/sweetalert.js"></script>
<script src="../js/jquery.min.js"></script>
		
		<script src="../js/bootstrap.min.js"></script>
  </head>

  <body class=" dark-bg">
  <!-- container section start -->
  <section id="container" class="">
     
      
       
      
      <!--main content start-->
      <section id="main-content" >
          <section class="wrapper">            
        
            </div>
          
          Admin
<h3>How to login </h3>
<ul>
<li>Provide your collect username and password </li>
<li>click on the button   </li>
<li>You will only be ale to login when you have entered the collect username and password </li>
</ul>
<h3> Staff account </h3>
<ul>
<li>To add a new staff click on the staff link </li>
<li>Provide the required details.  </li>
<li> Provide the username and password that staff will use to login to the system</li>
<li>To block a staff account under action use the select box to select inactive and click on the update button to block the staff form accessing the system </li>
</ul>
<h3>How to add a new apartment </h3>
<ul>
<li> Click on the apartment link.</li>
<li>In the page that appear fill in the apartment details on the form and click on the save button </li>
<li> The details will be added to the system if nor errors were made </li>
<li> To enter the rooms of the apartment under apartment link click on apartment no link </li>
<li> In the presented form select the apartment name and enter the room numbers  </li>
<li> To update any apartment details click on the edit button and edit the required date</li>
</ul>
<h3> Bookings </h3>
<ul>
<li>Click on the new booking links and you will be presented with a form where you can approve or reject the booking </li>
<li>To view all bookings Click on the payment link and select booking payments. </li>
</ul>
<h3> Rent Payment</h3>
<ul>
<li>Click on the rent payment link </li>
<li> in the table that appear use the select option to approve or reject the payment and click on the update button to save payment status</li>
<li> To view payment history click on the payment link and under it select rent payment</li>
</ul>
<h3>How to approve a vacate status </h3>
<ul>
<li>Click on the vacate notice link </li>
<li>select  the room that the tenant want to vacate by clicking on the select button  </li>
<li>  When you click the select button you will be presented with an interface where you will be required to select a staff member who will have an assignment </li>
<li>When a report about the apartment is reported back and the tenant pay the fine if any that is when u will be able to approve the tenant to vacate the room </li>
</ul>
<h3>How to send A feedback  </h3>
<ul>
<li>Select a pending feedback by clicking on the new feedback link  </li>
<li> In the page that appear select the feedback to reply to and after entering a reply click on the send button to send the reply</li>
</ul>
<h3> </h3>
<ul>
<li> </li>
<li> </li>
<li> </li>
<li> </li>
<li> </li>
<li></li>
</ul>
<h3> </h3>
<ul>

       
			
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

  </body>
</html>
