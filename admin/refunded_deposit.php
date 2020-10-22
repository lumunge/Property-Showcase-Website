<?php
session_start();

include('../assets/connection.php');
include('../assets/finalAdmin.php');
error_reporting(E_ERROR||E_PERSER);




?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title>Refunded Deposit</title>

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
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="info-box ">
										<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
</div>
					<div class="col-md-3">
						<div class=""><h4> Refunded Deposit</h4></div></div>
		       <div class="col-md-6">
		       	
		   <a href="refunded_deposit.php"><button class="btn btn-primary btn-sm btn-primary">Refund Deposit</button></a>
		    <a href="pending_deposit_refunds.php"><button class="btn btn-primary btn-sm btn-primary">Pending Deposit Refund</button></a>
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
<table class="table table-bordered" id="mytable">
	<thead>
				<td>Tenant</td>
				<td>Username</td>
				<td>Apartment Name</td>
				<td>Room</td>
				<td>Apartment Type</td>
				<td>Deposit</td>
				<td>Rent</td>
				<td>Due Date</td>
				<td>Vacate date</td>
				<td>Months Remaining</td>
				<td>Refund</td>
				<td>Status</td>
	</thead>
	<tbody>


<?php
	
	$select="SELECT * FROM vacate_notice AS vn INNER JOIN rooms AS r ON vn.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN bookings as b ON vn.booking_id=b.booking_id RIGHT JOIN tenants AS t ON t.tenant_id=vn.tenant_id WHERE b.booking_status='Vacated'  AND b.deposit_status='Refunded' ";
				$query=mysqli_query($conn,$select);
				while ($row=mysqli_fetch_array($query)){
		echo '
		<tr><form method="get">
		<td>'.$row['first_name'].'  '. $row['last_name'].' </td>
		<td>'.$row['username'].'</td>
		<td>'.$row['name'].'</td>
		<td>'.$row['room_no'].'</td>
		<td>'.$row['apartment_type'].'</td>
		
		<td>'.$row['rent_deposit'].'</td>
		<td>'.$row['rent'].'</td>
		<td>'.$dueDate=date('d-F-Y',strtotime($row['rent_due_date']));
					echo'</td>
					<td>'. $vacateDate = date('d-F-Y',strtotime($row['vacate_date']));
					echo '</td>
					';
					echo '<td>';
					   	   // culculate days left
														 $due = date_create($dueDate);
													 $vacateD = date_create($vacateDate);
												 $count = date_diff($due,$vacateD);
															   //count days
                                                          $diff=$count->format("%a");
															   // culculate rent to refund
														$rentPerDay=  $row['rent']/31;// rent per day
														// rent per day times days remaining
													 $rentRefund= $diff *  $rentPerDay;
														 // total refundable rent remaining plus deposite
													$refund=$rentRefund+$row['rent_deposit'];
					 $mths=round(($diff-30)/30);
					if($mths>0){
						echo $mths;
					}else{
						echo 'No months remainig';
					}
					echo '</td>';								
					echo '<td>';
					if($mths>0){
						echo $rowC['rent']+$rowC['rent']* $mths;
					}else{
						echo $rowC['rent'];
					}
					/*.round($refund)*/
						echo ' Ksh</td>';								
					echo '<td>'.$row['deposit_status'].'</td>
		
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
