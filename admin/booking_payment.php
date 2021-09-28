<?php
session_start();

error_reporting(E_ERROR||E_PERSER);

include('../assets/connection.php');
include('../assets/finalAdmin.php');
if ($_GET['statusBtn']){
	 $paymentID=$_GET['paymentID'];
	$status=$_GET['status'];
	$bookingID=$_GET['bookingID'];
	 $hhpayDay=$_GET['hpayDay'];
	$roomID=$_GET['roomID'];

	 
	// get the payment date and add on month when date is due
			$hhpayDay=date('d-m-Y');// get payment Date
			$dueDate=date('d-m-Y',strtotime("$hhpayDay + 1 months")); // add on month to the current date
			 'The current date';
			 $dueDate;
	
		if ($status=='Approved'){
			// update bookings table payment status
			$update1="UPDATE bookings SET rent_due_date='$dueDate',booking_status='Approved', booking_payment='Approved',booking_remarks='Booking Payment Accepted' WHERE booking_id='$bookingID'";
			mysqli_query($conn,$update1);
						 
	$update="UPDATE rent_payment SET payment_status='Approved',payment_remarks='Payment Accepted' WHERE payment_no='$paymentID'";
			if (mysqli_query($conn,$update)){
				$sweet='success';
				$feedback='Payment Approved';
			}
			}elseif($status=='Rejected'){
				$reject='<form method="get">
				<input type="hidden" name="paymentID"value="'.$paymentID.'">
				<input type="hidden" name="roomID"value="'.$roomID.'">
				<input type="hidden" name="bookingID"value="'.$bookingID.'">
				<label>Write a comment Why booking is Rejected</label>
				<textarea name="comment" class="form-control" required></textarea><br>

				<input type="submit" name="rejectBtn" value="Reject" class="btn btn-sm form-control btn-danger">
				</form>';
			}else{
				$sweet='error';
				$feedback='failed';
}
}

if(isset($_GET['rejectBtn'])){
	 $paymentID=$_GET['paymentID'];
	$comment=$_GET['comment'];
	$roomID=$_GET['roomID'];
	$bookingID=$_GET['bookingID'];
// update room status
	$upd="UPDATE rooms SET room_status='Empty' WHERE room_id='$roomID'";
	mysqli_query($conn,$upd);
	
				// update bookings table payment status
			$update1="UPDATE bookings SET booking_status='Rejected', booking_payment='Rejected',booking_remarks='$comment' WHERE booking_id='$bookingID'";
			mysqli_query($conn,$update1);
	//update bookings
	$update="UPDATE rent_payment SET payment_status='Rejected',payment_remarks='$comment' WHERE payment_no='$paymentID'";
			if (mysqli_query($conn,$update)){
				$sweet='success';
				$feedback='Booking Rejected';
			}
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title>Booking Payment</title>

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
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
					<div class="info-box ">
										
										<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
                                       
						</div>
									
					<div class="col-md-3">
						<div class=""> <h4>Bookings Payment</h4></div></div>
		            <div class="col-md-6">
		    <a href="booking_payment.php"><button class="btn btn-danger btn-sm btn-primary">New  Bookings</button></a>
		    <a href=""><button class="btn btn-primary btn-sm btn-primary">Approved Bookings</button></a>
		    <a href="rejected_booking_payment.php"><button class="btn btn-primary btn-sm btn-primary">Rejected Bookings</button></a>
		       </div>
		       <div class="col-lg-3">
		       			<?php
											echo $reject;
			                         ?>
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
	<th>Mpesa Code</th>
	<th>Amount Ksh</th>
	<th>Payment Date</th>
	<th>Status</th>
	<th>Action</th>
	</thead>
	<tbody>


<?php
	
	$select="SELECT * FROM bookings AS b INNER JOIN rooms AS r ON b.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN rent_payment AS rp ON b.booking_id=rp.booking_id RIGHT JOIN tenants AS t ON b.tenant_id=t.tenant_id WHERE rp.payment_status='Pending Approval' AND rp.type_of_payment='Booking Payment' ";
	$record=mysqli_query($conn,$select);
	while($row=mysqli_fetch_array($record)){
		echo '
		<tr><form method="get">
		<td>'.$row['first_name'].'  '. $row['last_name'].' </td>
		<td>'.$row['username'].'</td>
		<td>'.$row['name'].'</td>
		<td>'.$row['room_no'].'</td>
		<td>'.$row['apartment_type'].'</td>
		<td>'.$row['mpesa_code'].'</td>
		<td>'.$row['cash'].'</td>
		<td>'.$row['payment_date'].'</td>
		<td>'.$row['payment_status'].'</td>
		<td> 
		<input type="hidden" name="paymentID" value="'.$row['payment_no'].'">
		<input type="hidden" name="bookingID" value="'.$row['booking_id'].'">
		<input type="hidden" name="roomID" value="'.$row['room_id'].'">
		<input type="hidden" name="hpayDay" value="'.$row['payment_date'].'">
		<select name="status" class="form-control" required>
		<option></option>
		<option>Approved</option>
		<option>Rejected</option>
		</select>
		<input type="submit" name="statusBtn" value="Update" class="form-control btn-info"></td>
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
