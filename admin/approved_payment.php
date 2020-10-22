<?php
session_start();

error_reporting(E_ERROR||E_PERSER);

include('../assets/connection.php');
include('../assets/finalAdmin.php');


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title>Rejetced Payment</title>

     <link href="../css/adminNav.css" rel="stylesheet">
   <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <script src="../js/jquery.js"></script>
	  <script src="../js/bootstrap.min.js"></script>
	  
	  
	   <!-- javascripts -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery knob -->
    <script src="../js/jquery.knob.js"></script>
    <!--custome script for all page-->
    <script src="../js/scripts.js"></script>
    <script>

      //knob
      $(".knob").knob();

  </script>
   <link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
   <script src="../js/sweetalert.js"></script>
   
  </head>

  <body class=" dark-bg">
  <!-- container section start -->
  
   <?php
   
	if ($sweet=='error'){
	 echo"<script>
      swal('Error','".$feedback."')
        </script>";
	}elseif($sweet=='success'){
echo"<script>
      swal('Success','".$feedback."')
        </script>";
		
	}
	
	?>
  <section id="container" class="">
     
      
       
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
            
              
            <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="info-box ">
										<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
</div>
					<div class="col-md-3">
						<div class=""> <h4> Approved Payment</h4></div></div>
		            <div class="col-md-6">
		            
		    <a href="all_payment.php"><button class="btn btn-primary btn-sm btn-danger">All Payment</button></a>
		    <a href="approved_payment.php"><button class="btn btn-primary btn-sm btn-primary">Approved Payments</button></a>
		    <a href="all_rejected_payment.php"><button class="btn btn-primary btn-sm btn-primary">Rejacted Payments</button></a>
		       </div>
			       <script>
		function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
		</script> 
                      <!---END Print script==========================-->
                      
                      
                      <!-----PRint Area========---->
					 <div id="printableArea">			
<table  id="userTbl" class="table table-bordered"> 
	<thead>
	
	<th>Tenant Name</th>
	<th>Username</th>
	<th>Apartment</th>
	<th>Room No</th>
	<th>Apartment Type</th>
	<th>Payment For</th>
	<th>Mpesa Code</th>
	<th>Amount Ksh</th>
	<th>Payment Date</th>
	<th>Status</th>
	</thead>
	<tbody>


<?php
	
	$select="SELECT * FROM rent_payment AS rp INNER JOIN rooms AS r ON rp.room_id=r.room_id RIGHT JOIN tenants AS t ON rp.tenant_id=t.tenant_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN bookings AS b ON r.room_id=b.room_id WHERE rp.payment_status='Approved' ";
	$record=mysqli_query($conn,$select);
	while($row=mysqli_fetch_array($record)){
		echo '
		<tr><form method="get">
		<td>'.$row['first_name'].'  '. $row['last_name'].' </td>
		<td>'.$row['username'].'</td>
		<td>'.$row['name'].'</td>
		<td>'.$row['room_no'].'</td>
		<td>'.$row['apartment_type'].'</td>
		<td>'.$row['type_of_payment'].'</td>
		<td>'.$row['mpesa_code'].'</td>
		<td>'.$row['cash'].'</td>
		<td>'.$row['payment_date'].'</td>
		<td>'.$row['payment_status'].'</td>
		
		</form>
		</tr>
		';
		
	}
	
	?>
	</tbody>
</table >
						</div>	
							<script>
$(document).ready(function(){
    $('.search').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#userTbl tbody tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });
});
</script>	
							
					</div><!--/.info-box-->			
				</div><!--/.col-->
				
				
			
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
