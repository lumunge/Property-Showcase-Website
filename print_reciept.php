<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	// header('location:login.php');
	
	
}
if (isset($_POST['printBtn'])){
	$_SESSION['printID']=$_POST['printID'];
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title> Print reciept</title>
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
		<div class="col-lg-4 col-md-4">
			
			<a href="rent_payment_history.php" class="btn btn-primary btn-sm">Back </a>
		</div>
		<div class="col-lg-5 col-md-5">
			<h3 style="text-align: center"><em>Print reciept</em></h3>
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
				<th colspan="2" style="text-align: center" >Meru County Rentals</th>
				<?php
				
				$cart="SELECT * FROM rent_payment AS rp INNER JOIN rooms AS r ON rp.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id WHERE rp.payment_no='".$_SESSION['printID']."'   ";
				$query=mysqli_query($conn,$cart);
				$rowC=mysqli_fetch_array($query);
					echo '
				<tr><td><b>Payment No </b></td><td>'.$rowC['payment_no'].'</td></tr>
				<tr><td><b>Payment Date </b></td>	<td>'.$rowC['payment_date'].'</td></tr>
				<tr><td><b>Apartment Name </b></td>	<td>'.$rowC['name'].'</td></tr>
				<tr><td><b>Type </b></td><td>'.$rowC['apartment_type'].'</td></tr>
				<tr><td><b>Room No </b></td>	<td>'.$rowC['room_no'].'</td></tr>
				<tr><td><b>Mpesa Code </b></td>	<td>'.$rowC['mpesa_code'].'</td></tr>
				<tr><td><b>Cash </b></td><td>'.$rowC['cash'].'</td></tr>
				<tr><td><b>Balance </b></td>	<td>'.$rowC['balance'].'</td></tr>
				<tr><td><b>Payment FOr </b></td>	<td>'.$rowC['type_of_payment'].'</td></tr>
			<tr><td><b>Status </b></td><td>'.$rowC['payment_status'].'</td></tr>';
			
				?>
			</table>

			
		</div>
		</div>
	</div>
</div>

</body>
</html>