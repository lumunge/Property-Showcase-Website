<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	header('location:login.php');
	
}
if(isset($_GET['selectBtn'])){
		$_SESSION['hbookingID']=$_GET['hbookingID'];
	}

// pay rent

if (isset($_POST['makepaymentBtn'])){
	$mpesaCode=$_POST['mpesaCode'];
	$months=$_POST['months'];
	$amount=$_POST['amount']+$_SESSION['bal'];
	$total=$_POST['total'];
	$hroomID=$_POST['hroomID'];
	$hbookingID=$_POST['hbookingID'];
	
	$total=$months*$_SESSION['rent'];// get the total rent
	
	if (strlen($mpesaCode)<>10){
		$sweet='error';
		$feedback='Mpesa code Should contain 10 Characters';
	}elseif($amount< $total){
		$sweet='error';
		$feedback='The amount to pay for  '.$months.' Months is ' .$total. 'Ksh';
	}else{
		
		$bal=$amount-$total;// get the balance
		$paid=$amount-$_SESSION['bal'];
		$insert="INSERT INTO rent_payment(tenant_id,booking_id,room_id,mpesa_code,months,cash,balance,payment_remarks,type_of_payment)  VALUES ('".$_SESSION['tenantID']."','$hbookingID','$hroomID','$mpesaCode','$months', '$paid',$bal,'Pending','Rent Payment')";
		if(mysqli_query($conn,$insert)){
			
		$_SESSION['rentPay']='Payment Successfull';
				echo '<script>
	window.location.href="rent_payment_success.php";
	</script>
			';
			
	$mpesaCode='';
	$amount='';
	$months='';
		}else{
			$sweet='error';
		$feedback=' Payment failed';
		}
	}
}


if (isset($_POST['halfPaybtn'])){
	$mpesaCode=$_POST['mpesaCode'];
	$amount=$_POST['amount'];
	$hroomID=$_POST['hroomID'];
	$hbookingID=$_POST['hbookingID'];
	
	// rent per day
	 $perDay=$_SESSION['rent']/31;
	echo round($daysPaid=$amount/$perDay);
	
	if (strlen($mpesaCode)<>10){
		$sweet='error';
		$feedback='Mpesa code Should contain 10 Characters';
	}elseif($amount< $_SESSION['halfrent']){
		$sweet='error';
		$feedback='The amount to pay for half a month is Ksh';
	}else{
		$insert="INSERT INTO rent_payment(tenant_id,booking_id,room_id,mpesa_code,months,cash,payment_remarks,type_of_payment)  VALUES ('".$_SESSION['tenantID']."','$hbookingID','$hroomID','$mpesaCode','$daysPaid  Days','$amount','Pending','Rent Payment')";
		if(mysqli_query($conn,$insert)){
			
			$sweet='success';
		$_SESSION['rentPay']='Payment Successfull';
			
			echo '<script>
	window.location.href="rent_payment_success.php";
	</script>
			';
			
	$mpesaCode='';
	$amount='';
	$months='';
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

<title>Rent Payment</title>
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

			<h2 style="text-align: center"><em>Rent Payment</em></h2>
			<hr/>
	<div class="row">

		<div class="col-lg-1 col-md-1"></div>
		<div class="col-lg-4 col-md-4">
			<!--Pay For half a month??<button class="btn-link" data-toggle="modal" data-target="#myModal">Click Here</button>-->
			
		
				
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
					<tr><td>Balance </td><td>'.$_SESSION['bal']=$rowC['rent_balance'];'</td></tr>
					<tr><td>Due Date </td><td>'.$rowC['rent_due_date'].'</td></tr>
					</tr>';
				$_SESSION['rent']=$rowC['rent'];
			// divide rent By half to get the minimum rent
				$_SESSION['halfrent']=$rowC['rent'] / 2;
				?>
			</table>

			
		</div>
		<div class="col-md-4 col-lg-4">
		
		
			<p>Pay Bill No: 09876</p>
			<form method="post" autocomplete="off">
			
				<input type="hidden" name="total" class="form-control" value="<?php echo $suntotal; ?>" required>
				<input type="hidden" name="hroomID" class="form-control" value="<?php echo $rowC['room_id']; ?>" required>
				<input type="hidden" name="hbookingID" class="form-control" value="<?php echo $rowC['booking_id']; ?>" required>
				<label>Enter Mpesa Code</label>
				<input type="text" name="mpesaCode" value="<?php echo $mpesaCode ?>" class="form-control" required>
				<label>Months to Pay </label>
				<input type="number" name="months" min="1" value="<?php echo $months ?>" class="form-control" required>
				<label>Amount (Ksh <?php echo $min=$rowC['rent']-$_SESSION['bal'];?> )</em></label>
				<input type="number" name="amount"  value="<?php echo $amount  ?>" class="form-control" required><br>
             <input type="submit" name="makepaymentBtn" value="Submit Payment" class="form-control btn-primary " >
			</form>

  <!-- Modal 
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pay half the rent</h4>
        </div>
        <div class="modal-body">
        <form method="post" autocomplete="off">
        
				<input type="hidden" name="hroomID" class="form-control" value="<?php //echo $rowC['room_id']; ?>" required>
				<input type="hidden" name="hbookingID" class="form-control" value="<?php //echo $rowC['booking_id']; ?>" required>
        	<label>Enter Mpesa Code</label>
        	<input type="text" name="mpesaCode" class="form-control btn-default" required>
        	
        	<label>Amount to pay <em style="color: blue">
        	<?php /* $cashTopay=$_SESSION['halfrent']-$_SESSION['bal']; 
				if($cashTopay <1){
					// if the value is negative
					echo $halfRent=$_SESSION['bal']-$_SESSION['halfrent'];
				}else{
					echo  $halfRent=$_SESSION['halfrent']-$_SESSION['bal'];
				}*/
				?>  Ksh</em></label>
        	<input type="number" name="amount" min="<?php //echo //$halfRent; ?>" class="form-control btn-default" required><br>
<input type="submit"name="halfPaybtn" value="Make Payment" class="form-control btn-primary">
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>--->
		</div>
	</div>




</div>
</body>
</html>