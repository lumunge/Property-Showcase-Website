<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	header('location:login.php');	
}
if (isset($_POST['printBtn'])){
	 $_SESSION['hbookID']=$_POST['hbookID'];
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Collect Refund</title>
<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">
<script src="js/sweetalert.js"></script>
<script src="js/jquery.js"></script>
		
		<script src="js/bootstrap.min.js"></script>


</head>

<body>



<div class="container">
	<div class="row">
		
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
		<div class="col-lg-1 col-md-1">
			
		</div>
		<div class="col-lg-4 col-md-4">
			<h2 style="text-align: center"><em>Collect Refund</em></h2>
			
			
			<a href="refund.php" class="btn btn-primary btn-sm">Back</a>
			<hr/>
			<a href="#"><h4><span class="" onclick="printDiv('printableArea')" style="color: blue">Print</h4></span></a>
			
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
			
				<?php
				
				$select="SELECT * FROM vacate_notice AS vn INNER JOIN rooms AS r ON vn.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN bookings as b ON vn.booking_id=b.booking_id WHERE b.booking_status='Vacated' AND b.booking_id='".$_SESSION['hbookID']."' ";
				$query=mysqli_query($conn,$select);
				while ($rowC=mysqli_fetch_array($query)){
					echo '<tr>
					<tr><td colspan="2"><b>Apartment Name: '.$rowC['name'].'<br>
					Apartment Type:  '.$rowC['apartment_type'].'<br>
					Room Number   '.$rowC['room_no'].'</td></tr>
					<tr><td><b>Rent Deposit </b></td><td>'.$rowC['rent_deposit'].'</td></tr>
					<tr><td><b>Rent </b></td><td>'.$rowC['rent'].'</td></tr>
				<tr><td><b> Rent Due Date</b></td><td>'.$dueDate=date('d-m-Y',strtotime($rowC['rent_due_date']));
					echo'</td></tr>
					<tr><td><b> Vacate Date</b></td><td>'. $vacateDate = date('d-m-Y',strtotime($rowC['vacate_date']));
					echo '</td>
					';
					echo '<tr><td><b>Days Remaining </b></td><td>';
					   	   // culculate days left
														 $due = date_create($dueDate);
													 $vacateD = date_create($vacateDate);
												 $count = date_diff($due,$vacateD);
															   //count days
                                                          $diff=$count->format("%a");
															   // culculate rent to refund
														$rentPerDay=  $rowC['rent']/31;// rent per day
														// rent per day times days remaining
													 $rentRefund= $diff *  $rentPerDay;
														 // total refundable rent remaining plus deposite
												$refund=$rentRefund+$rowC['rent_deposit'];
					echo $diff;
					echo '</td></tr>';								
					echo '<tr><td><b>Total Refund </b></td><td>'.$_SESSION['refund']= round($refund);' Ksh</td></tr>';								
				
					}
				?>
			</table>

			
		</div>
		</div>
	
	</div>
</div>

</body>
</html>