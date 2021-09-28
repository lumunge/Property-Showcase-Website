<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	// header('location:login.php');
	
}
if(isset($_POST['payBtn'])){
		$_SESSION['hiddenID']=$_POST['hiddenID'];
	}
if (isset($_POST['makepaymentBtn'])){
	$mpesaCode=$_POST['mpesaCode'];
	$amount=$_POST['amount'];
	$total=$_POST['total'];
	$hroomID=$_POST['hroomID'];
	$hbookingID=$_POST['hbookingID'];
	if (strlen($mpesaCode)<>10){
		$sweet='error';
		$feedback='Mpesa code Should contain 10 Characters';
	}elseif($amount< $total){
		$sweet='error';
		$feedback=' Payment Should not be less than '.$total.'Ksh';
	}else{
		$insert="INSERT INTO rent_payment(tenant_id,booking_id,room_id,mpesa_code,cash,payment_status,payment_remarks, type_of_payment)  VALUES ('".$_SESSION['tenantID']."','$hbookingID','$hroomID','$mpesaCode','$amount','Pending Approval','N/A','Booking Payment')";
		if (mysqli_query($conn,$insert)){
			$update="UPDATE bookings SET booking_payment='Pending Approval' WHERE booking_id='$hbookingID'";
			mysqli_query($conn,$update);
			
			$sweet='success';
		$feedback='Booking Payment submited';
		}else{
			$sweet='error';
		$feedback=' Payment failed';
		}
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Booking Status</title>
<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">
<script src="js/sweetalert.js"></script>
<script src="js/jquery.js"></script>
		
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

			<h2 style="text-align: center"><em>Booking Payment</em></h2>
	<div class="row">

		<div class="col-lg-1 col-md-1"></div>
		<div class="col-lg-4 col-md-4">
			
			
		
				
			<table class="table table-bordered" id="mytable">
				<th colspan="2" style="text-align: center">Apartment Details</th>
				<?php
				
				$cart="SELECT * FROM bookings AS b INNER JOIN rooms AS r ON b.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id WHERE b.tenant_id='".$_SESSION['tenantID']."' AND b.booking_id='".$_SESSION['hiddenID']."' ";
				$query=mysqli_query($conn,$cart);
				$rowC=mysqli_fetch_array($query);
					echo '
					<tr><td>Apartment Name </td><td>'.$rowC['name'].'</td></tr>
					<tr><td>Type </td><td>'.$rowC['apartment_type'].'</td></tr>
					<tr><td>Room No </td><td>'.$rowC['room_no'].'</td></tr>
					<tr><td>Deposit </td><td>'.$rowC['rent'].'</td></tr>
					<tr><td>Rent </td><td>'.$rowC['rent'].'</td></tr>
					<tr><td>Total </td><td class="count-me" id="count">';
				echo $suntotal=$rowC['rent'] + $rowC['rent'];
				echo '</td></tr>';
			
				?>
			</table>

			
		</div>
		<div class="col-md-4 col-lg-4">
			<form method="post" autocomplete="off">
			
				<input type="hidden" name="total" class="form-control" value="<?php echo $suntotal; ?>" required>
				<input type="hidden" name="hroomID" class="form-control" value="<?php echo $rowC['room_id']; ?>" required>
				<input type="hidden" name="hbookingID" class="form-control" value="<?php echo $rowC['booking_id']; ?>" required>
				<label>Enter Mpesa Code</label>
				<input type="text" name="mpesaCode" value="<?php echo $mpesaCode ?>" class="form-control" required>
				<label>Amount to pay <em style="color: red"><?php echo $suntotal ?>Ksh</em></label>
				<input type="number" name="amount" value="<?php echo $amount  ?>" class="form-control" required><br>
             <input type="submit"name="makepaymentBtn" value="Submit Payment" class="form-control btn-primary " >
			</form>
		</div>
	</div>
</div>

</body>
</html>