<?php
session_start();

include('../assets/connection.php');
include('../assets/finalAdmin.php');
error_reporting(E_ERROR||E_PERSER);

if ($_GET['statusBtn']){
	 $bookingId=$_GET['bookingID'];
	$roomID=$_GET['roomID'];
	$status=$_GET['status'];

		if ($status=='Approved'){
	$update="UPDATE bookings SET booking_status='Approved',booking_remarks='Booking Accepted' WHERE booking_id='$bookingId'";
			if (mysqli_query($conn,$update)){
				$sweet='success';
				$feedback='Booking Approved';
			}
			}elseif($status=='Rejected'){
				$reject='<form method="get">
				<input type="hidden" name="bookingID"value="'.$bookingId.'">
				<input type="text" name="roomID"value="'.$roomID.'">
				<label>Write a comment Why Booking is Rejected</label>
				<textarea name="comment" class="form-control" required></textarea><br>

				<input type="submit" name="rejectBtn" value="Reject" class="btn btn-sm form-control btn-danger">
				</form>';
			}else{
				$sweet='error';
				$feedback='failed';
}
}

if(isset($_GET['rejectBtn'])){
	 $bookingId=$_GET['bookingID'];
	$roomID=$_GET['roomID'];
	$comment=$_GET['comment'];
// update room status
	$upd="UPDATE rooms SET room_status='Empty' WHERE room_id='$roomID'";
	mysqli_query($conn,$upd);
	//update bookings
	$update="UPDATE bookings SET booking_status='Rejected',booking_remarks='$comment' WHERE booking_id='$bookingId'";
			if (mysqli_query($conn,$update)){
				$sweet='success';
				$feedback='Booking Rejected';
			}
}
?>


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title>Pending Bookings</title>

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
            <div class="col-md- 1 col-lg-1"></div>
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
					<div class="info-box ">
										<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
</div>
					<div class="col-md-3">
						<div class=""><h4>Pending Bookings</h4></div></div>
		       <div class="col-md-6">
		       	
		    <a href="pending_bookings.php"><button class="btn btn-primary btn-sm btn-primary">Pending Bookings</button></a>
		    <a href="rejected_bookings.php"><button class="btn btn-primary btn-sm btn-primary">Rejected Bookings</button></a>
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
	<th>Status</th>
	<th>Action</th>
	</thead>
	<tbody>


<?php
	
	$select="SELECT * FROM bookings AS b INNER JOIN rooms AS r ON b.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN tenants AS t ON b.tenant_id=t.tenant_id  WHERE booking_status='Pending Approval'";
	$record=mysqli_query($conn,$select);
	while($row=mysqli_fetch_array($record)){
		echo '
		<tr><form method="get">
		<td>'.$row['first_name'].'  '. $row['last_name'].' </td>
		<td>'.$row['username'].'</td>
		<td>'.$row['name'].'</td>
		<td>'.$row['room_no'].'</td>
		<td>'.$row['apartment_type'].'</td>
		
		<td>'.$row['booking_status'].'</td>
		<td> 
		<input type="hidden" name="bookingID" value="'.$row['booking_id'].'">
		<input type="hidden" name="roomID" value="'.$row['room_id'].'">
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
