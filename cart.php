<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	header('location:login.php');
	
	
	if (isset($_POST['backBtn'])){
		header('location:index.php');
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>cart</title>
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
		<div class="col-md-2 col-lg-2">
			<table class="table">

	<th colspan="2">Available Rooms</th>
	<tr><td>Room NO</td></tr>

<?php
				// Remove Apartment
				if (isset($_POST['removeBtn'])){
					$hiddenID=$_POST['hiddenID'];
					$remove="DELETE FROM `bookings` WHERE `booking_id`='$hiddenID'  ";
	if(mysqli_query($conn,$remove)){
		$sweet='success';
	$feedback='Removed From Cart';
				}else{
		$sweet='success';
	$feedback='Removed From Cart';
	}
	}
				
				
				if (isset($_POST['cartBtn'])){
					
				
					$roomID=$_POST['roomID'];
				$apartmentno=$_POST['apartmentno']; // the apartment number
						// check if already in cart
				$sect="SELECT * FROM `bookings` WHERE `room_id`='$roomID' AND `tenant_id`='".$_SESSION["tenantID"]."' AND`booking_status`='Cart' ";
					$check=mysqli_query($conn,$sect);
					$num=mysqli_num_rows($check);
					if($num >0){
						$sweet='error';
						$feedback='Apartment already In your cart';
					}else{
						
			$insert="INSERT INTO `bookings` (`booking_id`, `room_id`, `tenant_id`, `booking_status`) VALUES (NULL,'$roomID', '".$_SESSION["tenantID"]."',  'Cart')";
					
					if (mysqli_query($conn,$insert)){
						$sweet='success';
					echo	$feedback='Added to cart';
					}else{
						$sweet='error';
						$feedback=" Failed to Add to cart";
				
				}
				}
				}
				
				
				
				
				
 	$apartmentID=$_SESSION['hiddenApID'];
	$descID=$_SESSION['hiddenDesID'];
				echo $_SESSION['hiddenname'];
	$select="SELECT * FROM `rooms` WHERE `apartment_id` ='".$_SESSION['hiddenApID']."' AND room_status='Empty' OR room_status='Cart'  ORDER BY `room_no` ASC ";
	$record=mysqli_query($conn,$select);
	while($row=mysqli_fetch_array($record)){
		echo '<tr>
		<form method="post">
		<td>'.$row['room_no'].'</td>
		<td>
		<input type="hidden" name="roomID" value="'.$row['room_id'].'">
		<input type="submit" name="cartBtn" value="Make Booking" class=" form-control btn-info"></td>
		</form>
		</tr>';
	}
	
	?>
</table>
		</div>
		
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
		<div class="col-lg-2 col-md-2"></div>
		<div class="col-lg-6 col-md-6">
			<h2 style="text-align: center"><em>Booking Cart</em></h2>
			<hr/>
			<?php
			echo $feedback;
			?>
			<table class="table" id="mytable">
				<td>Apartment Name</td>
				<td>Type</td>
				<td>Room No</td>
				<td>Rent</td>
				<td>Deposit</td>
				<td>Sub Total</td>
				<td>Action</td>
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
					<td class="count-me" id="count">'.$suntotal=$rowC['rent'] + $rowC['rent'].'</td>
					<td><input type="hidden" name="hiddenID" value="'.$rowC['booking_id'].'"><input type="submit" name="removeBtn" value="Remove" class="form-control btn-danger"></td>
					</form>
					</tr>';
				}
				
				
				echo '<tr> <td colspan="5">Total<td>'.$rent.'</td> </tr>';
			echo	'<tr>
				<td colspan="3"><a href="index.php"><input type="submit" name="backBtn" value="Go back" class="form-control btn-danger"></a></td>
					<td colspan="4"><a href="checkout.php"><input type="submit" value="Check Out" class=" form-control btn-info"></a></td>
					</tr>';
				
				?>
			</table>
			    <!---    <script language="javascript" type="text/javascript">
            var tds = document.getElementById('mytable').getElementsByTagName('td');
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'count-me') {
                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }
            document.getElementById('mytable').innerHTML += '<tr><td colspan="5">Total</td><td>' + sum + '</td></tr><?php  ?>';
        </script>
        </tr> 
			<tr>
			<td colspan="3"><a href="index.php"><input type="submit" name="backBtn" value="Go back" class="form-control btn-danger"></a></td>
					<td colspan="4"><a href="checkout.php"><input type="submit" value="Check Out" class=" form-control btn-info"></a></td>
					</tr>	--->
			
		</div>
	</div>
</div>

</body>
</html>