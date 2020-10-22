<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
// header('location:login.php');
}

if(isset($_POST['payBtn'])){

$hbookID=$_POST['hbookID'];
$hroomID=$_POST['hroomID'];
$mpesaCode=$_POST['mpesaCode'];
$amount=$_POST['amount'];
$hbalance=$_POST['hbalance'];

$bal=$hbalance+$amount;

$insert="INSERT INTO rent_payment(tenant_id,room_id,booking_id,mpesa_code,cash,balance,payment_remarks,type_of_payment)VALUES('".$_SESSION['tenantID']."','$hroomID','$hbookID','$mpesaCode','$amount','$bal','Wait for balance to be approved','Balance Payment')";
if(mysqli_query($conn,$insert)){

$sweet='success';
$feedback='Payment submited';
}else{
$sweet='error';
$feedback='Failed to submited';
}

}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tenant Booking History</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/sweetalert.css">
<script src="js/sweetalert.js"></script>
<style>
.table {
background-color: #333;
color: #faebd7;
font-weight: 400;
font-size: 2rem;
}
.btn {
background-color: #333;
color: #adff2f;
font-size: 1.5rem;
margin: 1rem;
text-transform: uppercase;
}
.btn:hover {
color: #fff;
background-color: #000;
transition: 1s ease;
}
</style>
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

<div class="col-lg-1 col-md-1">
<a href="profile.php" class="btn btn-primary btn-sm">Back to profile</a>
</div>
<div class="col-lg-12 col-md-12">
<h2 style="text-align: center">TENANT BOOKING HISTORY</h2>
<hr/>

<table class="table table-bordered" id="mytable">
<td>Apartment Name</td>
<td>Type</td>
<td>Room No</td>
<td>Rent</td>
<td>Deposit</td>
<td>Balance</td>
<td>Sub Total</td>
<td>Status</td>
<td>Payment</td>
<td>Comment</td>
<?php

$cart="SELECT * FROM bookings AS b INNER JOIN rooms AS r ON b.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN rent_payment AS rp ON b.booking_id=rp.booking_id WHERE b.tenant_id='".$_SESSION['tenantID']."' AND rp.type_of_payment='Booking Payment' AND NOT b.booking_status='Cart' ORDER BY b.booking_id DESC ";
$query=mysqli_query($conn,$cart);
while ($rowC=mysqli_fetch_array($query)){
echo '<tr>
<form method="post" action="booking_payment.php">
<td>'.$rowC['name'].'</td>
<td>'.$rowC['apartment_type'].'</td>
<td>'.$rowC['room_no'].'</td>
<td>'.$rowC['rent'].'</td>
<td>'.$rowC['rent'].'</td>
<td>'.$rowC['rent_balance'].'</td>
<td class="count-me" id="count">'.$suntotal=$rowC['rent'] + $rowC['rent'].'</td>';
echo '<td>';
if ($rowC['rent_balance'] < 0 AND $rowC['booking_status']=='Approved'){
echo '<em style="color:red">Partially approved Please pay the balance in 14 days</em>';

echo '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#'.$rowC['booking_id'].'">Click to pay</button>';

}else{
echo $rowC['booking_status'];
}
echo'</td>
<td><input type="hidden" name="hiddenID" value="'.$rowC['booking_id'].'">';


// if booking is pending
if($rowC['booking_status']=='Pending Approval'){
echo 'Pending';
// when booking is approved

}elseif($rowC['booking_payment']=='Rejected'){
echo 'Booking Payment rejected.';
}elseif($rowC['booking_payment']=='Approved'){
echo 'Payment Accepted';
}
elseif($rowC['booking_status']=='Approved'){
echo'  <input type="submit" name="payBtn" value="Make Payment" class="form-control btn-primary btn-sm">';
// when booking is rejacted
}elseif($rowC['booking_status']=='Rejected'){
echo 'N/A';
}
echo'</td><td>';
if ($rowC['booking_status']=='Pending Approval'){
echo "Please wait for your booking to be approved";
}else{
echo $rowC['booking_remarks'];
}
echo'</td></form>
</tr>';
}
?>
</table>

</div>

<?php

$cart="SELECT * FROM bookings AS b INNER JOIN rooms AS r ON b.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN rent_payment AS rp ON b.booking_id=rp.booking_id WHERE b.tenant_id='".$_SESSION['tenantID']."' AND rp.type_of_payment='Booking Payment' AND NOT b.booking_status='Cart' ORDER BY b.booking_id DESC ";
$query=mysqli_query($conn,$cart);
while ($rowP=mysqli_fetch_array($query)){
?>
<div class="modal fade" id="<?php echo $rowP['booking_id'];?>" role="dialog">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Make payment</h4>
<p>Pay Bill No: 09876
</div>
<div class="modal-body">

<form method="post" autocomplete="off">
Apartment Name <?php echo $rowP['name']?><br>
Balance <?php echo $rowP['balance']?><br>
<input type="hidden" name="hbookID" value="<?php echo $rowP['booking_id'];?>">
<input type="hidden" name="hroomID" value="<?php echo $rowP['room_id'];?>">
<input type="hidden" name="hbalance" value="<?php echo $rowP['balance'];?>">
<label>Mpesa Code</label>
<input type="text" name="mpesaCode" value="<?php echo $_POST['mpesaCode'];?>" class="form-control">
<label>Amount</label>
<input type="number" name="amount" value="<?php echo $_POST['amount'];?>" class="form-control"><br>
<input type="submit" name="payBtn" value="Submit Payment" class="btn btn-md btn-primary">
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<?php

}
?>

</div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>