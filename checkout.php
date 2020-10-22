<?php
error_reporting(E_ERROR);
session_start();
  $_SESSION['hiddenApID'];
	
 $_SESSION["tenantID"];
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	header('location:login.php');
	
}

if(isset($_POST['payBtn'])){
	
	$hbookID=$_POST['hbookID'];
	$hroomID=$_POST['hroomID'];
	$hrent=$_POST['hrent'];
	$mpeseCode=$_POST['mpesaCode'];
	$amount=$_POST['amount'];
	
	$htotol=$_POST['htotol']; // rent + deposit
	
	if (strlen($mpeseCode)<>10)  {
		$sweet='error';
		 $feedback="Mpesa code should have 10 characters";
		
		if($amount < $htotol){
			$bal=$htotol-$amount;
			$insert="INSERT INTO rent_payment(tenant_id,room_id,booking_id,mpesa_code,cash,amount_remaining,payment_remarks,type_of_payment)VALUES('".$_SESSION['tenantID']."','$hroomID','$hbookID','$mpeseCode','$amount','$bal','Wait for your booking to be approved','Booking Payment')";
			mysqli_query($conn,$insert);
			// update booking status where statues = cart
			$sql="UPDATE `bookings` SET `booking_status`='Pending Approval',rent_deposit='$hrent',rent_balance='0' WHERE `tenant_id`='".$_SESSION['tenantID']."'AND booking_id='$hbookID' AND booking_status='Cart' ";
		mysqli_query($conn,$sql);
				
			// update Apartment_no status where status= empty
	
		 $sql="UPDATE `rooms` SET `room_status`='Booked' WHERE `room_id`='$hroomID' ";
		mysqli_query($conn,$sql);
			$sweet='success';
			$feedback='Booking Submited';
		
	header('location:checkout_success.php');
		}
		
	}else{
	$bal=($amount -$hrent)-$hrent; // calculate rent balance
	$insert="INSERT INTO rent_payment(tenant_id,room_id,booking_id,mpesa_code,cash,balance,payment_remarks,type_of_payment)VALUES('".$_SESSION['tenantID']."','$hroomID','$hbookID','$mpeseCode','$amount','$bal','Wait for your booking to be approved','Booking Payment')";
		if (mysqli_query($conn,$insert)){
			
	// update booking status where statues = cart
			
			 
			
		 $sql="UPDATE `bookings` SET `booking_status`='Pending Approval',rent_deposit='$hrent',rent_balance='$bal' WHERE `tenant_id`='".$_SESSION['tenantID']."'AND booking_id='$hbookID' AND booking_status='Cart' ";
		mysqli_query($conn,$sql);
			
			// update Apartment_no status where status= empty
	
		 $sql="UPDATE `rooms` SET `room_status`='Booked' WHERE `room_id`='$hroomID' ";
		mysqli_query($conn,$sql);
			$sweet='success';
			$feedback='Booking Submited';
		
	header('location:checkout_success.php');
	}else{
				$sweet='error';
			 $feedback='Failed to submit payment';
		}
	}
	}
		
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Checkout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/sweetalert.css">
  <script src="js/jquery.js"></script>
  <script src="js/sweetalert.js"></script>
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
<div class="jumbotron">
<div class="container">
 


<div class="row">
		<div class="col-md-1 col-lg-1">
		
		</div>
		<div class="col-lg-2 col-md-2"></div>
		<div class="col-lg-6 col-md-6">
			<h2 style="text-align: center"><em>Check out</em></h2>
			<hr/>
			
			<table class="table">
			<tbody style="background-color: green;color: whitesmoke">
				<td>Apartment Name</td>
				<td>Type</td>
				<td>Room No</td>
				<td>Rent</td>
				<td>Deposit</td>
				<td>Sub Total</td>
				<td>Pay</td>
				</tbody>
				<?php
				
				// count the total rent 
			$count="SELECT sum(rent) FROM bookings AS b INNER JOIN rooms AS r ON b.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id WHERE b.tenant_id='".$_SESSION['tenantID']."' AND b.booking_status='Cart' ";
				
				$get=mysqli_query($conn,$count);
				while($rows=mysqli_fetch_array($get)){
				$rent= $rows['sum(rent)'] * 2;
				
				}
				
				
				$cart="SELECT * FROM bookings AS b INNER JOIN rooms AS r ON b.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id WHERE b.tenant_id='".$_SESSION['tenantID']."' AND b.booking_status='Cart' ";
				$query=mysqli_query($conn,$cart);
				while ($rowC=mysqli_fetch_array($query)){
					echo '<tr>
					<form method="post">
					<td>'.$rowC['name'].'</td>
					<td>'.$rowC['apartment_type'].'</td>
					<td>'.$rowC['room_no'].'</td>
					<td>'.$rowC['rent'].'</td>
					<td>'.$rowC['rent'].'</td>
					<td>'.$sumtotal=$rowC['rent'] + $rowC['rent'].'
					</td>';
				
					?>
						<!----Payment Model---->
						<td>
						<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#<?php echo $rowC['booking_id'] ?>payModel">Book </button>
						<div class="modal fade" id="<?php echo $rowC['booking_id'] ?>payModel" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Make payment</h4>
			<p>Pay Bill No: 09876
        </div>
        <div class="modal-body">
          <?php echo $rowC['name'] ?><br>
         Room No <?php echo $rowC['room_no']  ?><br>
         <hr>
         <form method="post" autocomplete="off">
         
         	<input type="hidden"name="hroomID" value="<?php echo $rowC['room_id'] ?>" class="form-control">
         	<input type="hidden"name="hbookID" value="<?php echo $rowC['booking_id'] ?>" class="form-control">
         	<input type="hidden"name="hrent" value="<?php echo $rowC['rent'] ?>" class="form-control">
         	<input type="hidden"name="htotol" value="<?php echo $rowC['rent']*2 ?>" class="form-control">
         	<label>Mpesa Code</label>
         	<input type="text"name="mpesaCode" class="form-control" id="mcode" onchange="myFunction()">
         	<label>Amount <?php echo $fee=$rowC['rent']*2 ?></label>
         	<input type="number" min="<?php echo $fee*0.5;?>" name="amount" class="form-control"><br>
<input type="submit" name="payBtn"value="make payment" class="form-control btn-sm btn-primary">
         </form>
         <script>
function myFunction() {
    var x = document.getElementById("mcode");
    x.value = x.value.toUpperCase();
}
</script>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>	
						</td>
					</tr>
					<?php
				}
				
				?>
				<tr> <td colspan="5">Total<td><?php echo $rent ?></td> </tr>
				<?php
				if (mysqli_num_rows($query) ==0){
					
				}else{
				
				echo '<tr> 
				<td colspan="7"><a href="cart.php"><input type="button" name="backBtn" value="Go To Cart" class="form-control btn-info"></a></td>
					<td colspan="4"></td>
					</tr>';
					
				}
				?>
				
				
				
			</table>
		</div>
	</div>
	</div>
	</div>

</body>
</html>
