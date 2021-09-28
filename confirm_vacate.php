<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	header('location:login.php');
}

if (isset($_GET['selectBtn'])){
	$_SESSION['hnoticeID']=$_GET['hnoticeID'];
	$_SESSION['hbookingID']=$_GET['hbookingID'];
}

if (isset($_POST['vacateBtn'])){
	$hroomID=$_POST['hroomID'];
	// update rooms
	$update="UPDATE rooms SET room_status='Empty' WHERE room_id='".$_SESSION['hroomID']."'";
	if(mysqli_query($conn,$update)){
		// Update bookings
			$updateB="UPDATE bookings SET booking_status='Vacated',exit_status='Vacated' WHERE booking_id='".$_SESSION['hbookingID']."'";
	mysqli_query($conn,$updateB);
		
		$show='success';
		$fb='Apartment vacated';
		echo'
		<script>
		location.href = "inspection_report.php";
		</script>';
		
	}else{
		$show='error';
		$fb='Failed to submit';
	}
}


if (isset($_POST['payBtn'])){
	$mpesaCode=$_POST['mpesaCode'];
    $amount=$_POST['amount'];
	if (strlen($mpesaCode )<>10){
		$sweet='error';
		$feedback="Mpesa card should Contain 10 character";
	}elseif($amount <$_SESSION['fine'] ){
		$sweet='error';
		$feedback='fine amount should be '.$_SESSION['fine'].' ';
	}else{
		$insert="INSERT INTO rent_payment(tenant_id,booking_id,room_id,mpesa_code,cash,payment_remarks,type_of_payment)  VALUES ('".$_SESSION['tenantID']."','".$_SESSION['hbookingID']."','".$_SESSION['hroomID']."','$mpesaCode','$amount','Pending','Fine Payment')";
		if(mysqli_query($conn,$insert)){
			
			// update inspection report fine status
			$update="UPDATE inspection_report SET fine_status='Submited' WHERE notice_id='".$_SESSION['hnoticeID']."'";
			mysqli_query($conn,$update);
			
			$sweet='success';
		$feedback='Payment Successfull';
			
			
	$mpesaCode='';
    $amount='';
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

<title>Inspection Report</title>
<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">
<script src="js/sweetalert.js"></script>
<script src="js/jquery.js"></script>
		
		<script src="js/bootstrap.min.js"></script>


</head>

<body>



<div class="container-fluid">
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
	
	<div class="col-md-2">
		
	</div>
	<div class="col-md-10">
		
			<a href="vacate_status.php" class="btn btn-primary btn-sm">Back</a>
	</div>
	</div>
		<div class="row">
		<div class="col-lg-4">
		
			<form method="post" autocomplete="off">
		
				<label><input type="checkbox" required>Check to confirm </label>
				
				<br>
                  <input type="submit" name="vacateBtn" value="Click to vacate" class="form-control btn-primary" >
			</form>
		</div>
		<div class="col-lg-4 col-md-4">
			<hr/>
			
			<table class="table table-bordered" id="mytable">
				<th colspan="2" style="text-align:center">Apartment Details</th>
				<?php
				
				$cart="SELECT * FROM vacate_notice AS v INNER JOIN rooms AS r ON v.room_id=r.room_id RIGHT JOIN apartment AS a on r.apartment_id=a.apartment_id RIGHT JOIN inspection_report AS ip ON v.notice_id=ip.notice_id WHERE v.notice_id='".$_SESSION['hnoticeID']."'";
				$query=mysqli_query($conn,$cart);
				while ($rowC=mysqli_fetch_array($query)){
					echo '
					<tr><td><b>Apartment </b></td><td>'.$rowC['name'].'</td></tr>
					<tr><td><b>Type </b></td><td>'.$rowC['apartment_type'].'</td></tr>
					<tr><td><b>Room No </b></td><td>'.$rowC['room_no'].'</td></tr>
					<tr><td><b>Vacate Date </b></td><td>'.$rowC['vacate_date'].'</td></tr>
					<tr><td><b>Status </b></td><td>'.$rowC['vacate_status'].'</td></tr>
					';
				}
				?>
			</table>

			
		</div>
		
		<div class="col-lg-4 col-md-4">
			<hr/>
			
			<table class="table table-bordered" id="mytable">
				<th colspan="2" style="text-align:center">Inspection Report</th>
				<?php
				
				$cart="SELECT * FROM vacate_notice AS v INNER JOIN rooms AS r ON v.room_id=r.room_id RIGHT JOIN apartment AS a on r.apartment_id=a.apartment_id RIGHT JOIN inspection_report AS ip ON v.notice_id=ip.notice_id RIGHT JOIN bookings AS b ON v.booking_id=b.booking_id WHERE v.notice_id='".$_SESSION['hnoticeID']."'";
				$query=mysqli_query($conn,$cart);
				while ($rowC=mysqli_fetch_array($query)){
					echo '
					<tr><td><b>Inspection Date </b></td><td>'.$rowC['inspection_date'].'</td></tr>
					<tr><td><b>Fine </b></td><td>'.$rowC['fine'].'</td></tr>
					<tr><td><b>Report </b></td><td>'.$rowC['inspection_report'].'</td></tr>
					<td colspan="2" style="text-align:center">';
					
					if ($rowC['fine'] < 1){ // if no fine  //
						echo '<form method="post" action="#">
					<input type="hidden" name="hnoticeID" value="'.$rowC['notice_id'].'">
					<input type="hidden" name="hroomID" value="'.$rowC['room_id'].'">
					';
					}elseif($rowC['fine_status']=='Payment Pending' ){
						echo $rowC['fine_status'];
						
					}elseif($rowC['fine_status']=='Submited' ){
						echo 'Fine'.' ' .$rowC['fine_status'].'. '.'Pending Approval';
						
					}elseif($rowC['booking_status']=='Vacated' ){
						echo 'Apartment Vacated';
					}
					elseif($rowC['fine_status']=='Payment Approved' ){
						echo '<form method="post" action="#">
					<input type="hidden" name="hnoticeID" value="'.$rowC['notice_id'].'">
					<input type="hidden" name="hroomID" value="'.$rowC['room_id'].'">
					<input type="button" name="vacateBtn" value="Vacate Apartment" class="form-control btn-primary btn-sm">
					</form>';
					}
					$_SESSION['fine']=$rowC['fine'];
					$_SESSION['fineStatus']=$rowC['fine_status'];
					$_SESSION['hroomID']=$rowC['room_id'];
					
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