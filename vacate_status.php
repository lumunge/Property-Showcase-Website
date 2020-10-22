<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	// header('location:login.php');

}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Vacate Status</title>
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
		<div class="col-lg-1 col-md-1"></div>
		<div class="col-lg-10 col-md-10">
			<h2 style="text-align: center"><em>Vacate Status</em></h2>
			
			<a href="profile.php" class="btn btn-primary btn-sm">Back to profile</a>
			<hr/>
			
			<table class="table table-bordered" id="mytable">
				<td>Apartment Name</td>
				<td>Type</td>
				<td>Room No</td>
				<td>Vacate Date</td>
				<td>Vacate Reason</td>
				<td>Status</td>
				<td>Comment</td>
				<td>Action</td>
				<?php
				
				$cart="SELECT * FROM vacate_notice AS v INNER JOIN bookings AS b ON v.booking_id=b.booking_id RIGHT JOIN rooms AS r ON v.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id  WHERE v.tenant_id='".$_SESSION['tenantID']."' ORDER BY v.notice_id DESC";
				$query=mysqli_query($conn,$cart);
				while ($rowC=mysqli_fetch_array($query)){
					echo '<tr>
					<td>'.$rowC['name'].'</td>
					<td>'.$rowC['apartment_type'].'</td>
					<td>'.$rowC['room_no'].'</td>
					<td>'.$rowC['vacate_date'].'</td>
					<td>'.$rowC['vacate_reason'].'</td>
					<td>'.$rowC['vacate_status'].'</td>
					<td>'.$rowC['vacate_remarks'].'</td><td>';
					
					if ($rowC['vacate_status']=='Inspected'){
						echo '<form method="get" action="inspection_report.php">
					<input type="hidden" name="hbookingID" value="'.$rowC['booking_id'].'">
					<input type="hidden" name="hnoticeID" value="'.$rowC['notice_id'].'">
					<input type="Submit" name="selectBtn" value="Details" class="btn btn-primary btn-sm"></form>';
					}else{
						echo $rowC['vacate_status'];
					}
					
					
				echo	'</td>
					</tr>';
				}
				?>
			</table>

			
		</div>
	</div>
</div>

</body>
</html>