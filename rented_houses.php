<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
// header('location:login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Tenant Rented Apartment</title>
<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">
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

<div class="col-lg-1 col-md-1">
<a href="profile.php" class="btn">Back to profile</a>
</div>
<div class="col-lg-10 col-md-10">
<h2 style="text-align: center"><em>Tenant Rented Apartment/s</em></h2>

<a href="vacate_apartment.php" class="btn">Vacate Apartment</a>
<hr/>

<table class="table table-bordered" id="mytable">
<td>Apartment Name</td>
<td>Type</td>
<td>Room No</td>
<td>Deposit</td>
<td>Rent</td>
<td>Balance</td>
<td>Due Date</td>
<td>Action</td>
<?php

$cart="SELECT * FROM bookings AS b INNER JOIN rooms AS r ON b.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN rent_payment AS rp ON b.booking_id=rp.booking_id WHERE b.tenant_id='".$_SESSION['tenantID']."' AND b.booking_payment='Approved' AND rp.type_of_payment='Booking Payment' AND b.booking_status='Approved' ";
$query=mysqli_query($conn,$cart);
while ($rowC=mysqli_fetch_array($query)){
echo '<tr>
<td>'.$rowC['name'].'</td>
<td>'.$rowC['apartment_type'].'</td>
<td>'.$rowC['room_no'].'</td>
<td>'.$rowC['rent_deposit'].'</td>
<td>'.$rowC['rent'].'</td>';
echo '<td>';

echo $rowC['rent_balance'];

echo '</td>';
echo '<td>'.$rowC['rent_due_date'].'</td>
<td><form method="get" action="rent_payment.php">
<input type="hidden" name="hbookingID" value="'.$rowC['booking_id'].'">
<input type="Submit" name="selectBtn" value="Pay rent" class="btn btn-primary">
</form>


</form>
</td>
</tr>';
}
?>
</table>


</div>
</div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>