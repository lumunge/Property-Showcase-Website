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

<title>Vacate Apartment</title>
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
		<div class="col-lg-8 col-md-8">
			<h2 style="text-align: center"><em>Vacate Apartment/s</em></h2>
			<a href="rented_houses.php" class="btn btn-primary btn-sm">Rented Houses</a>
			<a href="vacate_status.php" class="btn btn-primary btn-sm">Vacate Status</a>
			<a href="refund.php" class="btn btn-primary btn-sm">Refund</a>
			<hr/>
			
			<table class="table table-bordered" id="mytable">
				<td>Apartment Name</td>
				<td>Type</td>
				<td>Room No</td>
				<td>Deposit</td>
				<td>Rent</td>
				<td>Due Date</td>
				<td>Action</td>
				<?php
				
				$select="SELECT * FROM rooms AS r INNER JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN bookings AS b ON r.room_id=b.room_id WHERE b.tenant_id='".$_SESSION['tenantID']."' AND b.booking_payment='Approved' ";
				$query=mysqli_query($conn,$select);
				while ($rowC=mysqli_fetch_array($query)){
					echo '<tr>
					<td>'.$rowC['name'].'</td>
					<td>'.$rowC['apartment_type'].'</td>
					<td>'.$rowC['room_no'].'</td>
					<td>'.$rowC['rent_deposit'].'</td>
					<td>'.$rowC['rent'].'</td>
					<td>'.$rowC['rent_due_date'].'</td>
					<td>';
					if ($rowC['exit_status']=='Sent'){
						echo 'Vacate notice sent';
						}elseif($rowC['exit_status']=='Vacated'){
						echo 'Apartment Vacated';
					
					}elseif($rowC['exit_status']=='Rejected'){
						echo 'Vacate notice rejected. check vacate status before applying again ';
						echo '<form method="get" action="send_vacate_notice.php">
					<input type="hidden" name="hbookingID" value="'.$rowC['booking_id'].'">
					<input type="Submit" name="selectBtn" value="Apply again" class="btn btn-danger btn-sm">
					
					</form>';
					}elseif($rowC['exit_status']=='Not Sent'){
					echo '<form method="get" action="send_vacate_notice.php">
					<input type="hidden" name="hbookingID" value="'.$rowC['booking_id'].'">
					<input type="Submit" name="selectBtn" value="Select" class="btn btn-primary btn-sm">
					
				</form>';
				}
				}
				echo '</td>
					</tr>';
				?>
			</table>

			
		</div>
	</div>
</div>

</body>
</html>