<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	// header('location:login.php');
	
}
if(isset($_GET['selectBtn'])){
		 $_SESSION['hbookingID']=$_GET['hbookingID'];
	}

if (isset($_GET['sendNoticeBtn'])){
	$hroomID=$_GET['hroomID'];
	$date=$_GET['vacateDate'];
	$reason=$_GET['reason'];
	
		$insert="INSERT INTO vacate_notice(booking_id,tenant_id,room_id,vacate_date,vacate_reason,vacate_remarks)  VALUES ('".$_SESSION['hbookingID']."','".$_SESSION['tenantID']."','$hroomID','$date','$reason','Pending')";
		if (mysqli_query($conn,$insert)){
			
		$update="UPDATE bookings SET exit_status='Sent' WHERE booking_id='".$_SESSION['hbookingID']."'";
			mysqli_query($conn,$update);
			
			$sweet='success';
		$feedback='Vacate notice submited';
		}else{
			$sweet='error';
		$feedback=' Failed to send ';
		}
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Send Vacate Notice</title>
<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="css/datepicker3.css" rel="stylesheet" type="text/css">
<script src="js/datepicker.min.js"></script>
<script src="js/sweetalert.js"></script>
<script src="js/jquery.min.js"></script>
		
		<script src="js/bootstrap.min.js"></script>


</head>

<body>


		
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
<div class="container">

			<h2 style="text-align: center"><em>Send Vacate Notice</em></h2>
	<div class="row">

		<div class="col-lg-1 col-md-1">
			
					
		</div>
		<div class="col-lg-4 col-md-4">
	
		
				
			<table class="table table-bordered" id="mytable">
				<th colspan="2" style="text-align: center">Apartment Details</th>
				<?php
				
				$cart="SELECT * FROM bookings AS b INNER JOIN rooms AS r ON b.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id WHERE b.tenant_id='".$_SESSION['tenantID']."' AND b.booking_id='".$_SESSION['hbookingID']."' ";
				$query=mysqli_query($conn,$cart);
				$rowC=mysqli_fetch_array($query);
					echo '
					<tr><td>Apartment Name </td><td>'.$rowC['name'].'</td></tr>
					<tr><td>Type </td><td>'.$rowC['apartment_type'].'</td></tr>
					<tr><td>Room No </td><td>'.$rowC['room_no'].'</td></tr>
					<tr><td>Rent </td><td>'.$rowC['rent'].'</td></tr>
					<tr><td>Due Date </td><td>'.$rowC['rent_due_date'];'</td></tr>
					</tr>';
			// divide rent By half to get the minimum rent
				$_SESSION['halfrent']=$rowC['rent'] / 2;
				?>
			</table>

			
		</div>
		<div class="col-md-4 col-lg-4">
			<form method="get" autocomplete="off">
			
				<input type="hidden" name="hroomID" class="form-control" value="<?php echo $rowC['room_id']; ?>" required>
				
				<label>Vacate Date</label>
				<input type="text" name="vacateDate" value="<?php echo $date ?>" class="form-control" required readonly>
				<label>Vacate Reason</em></label>
				<textarea name="reason" value="<?php echo $reason  ?>" class="form-control" required></textarea><br>
             <input type="submit" name="sendNoticeBtn" value="Submit " class="form-control btn-primary " >
			</form>
			
			


		
		</div>
	</div>
</div>
	
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>

	<script>
	$(document).ready(function(){
		var date_input=$('input[name="vacateDate"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd-mm-yyyy',
			todayHighlight: true,
			orientation: "top auto",
			autoclose: true,
			startDate:new Date(),
			endDate:'<?php echo $rowC['rent_due_date'] ?>',
		})
	})
</script>
</body>
</html>