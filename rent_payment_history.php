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
<title>Tenant Payment History</title>
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
<a href="profile.php" class="btn">Back to profile</a>
</div>
<div class="col-lg-12 col-md-12">
<h2 style="text-align: center"><em>Tenant Payment History</em></h2>
<hr/>

<table class="table table-bordered" id="mytable">
<td>Apartment Name</td>
<td>Type</td>
<td>Room No</td>
<td>Mpesa Code</td>
<td>Amount Paid (Ksh)</td>
<td>Balance (Ksh)</td>
<td>Payment For</td>
<td>Payment Date</td>
<td>Status</td>
<td>Comment</td>
<td>Action</td>

<?php
$cart="SELECT * FROM rent_payment AS rp INNER JOIN rooms AS r ON rp.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id WHERE rp.tenant_id='".$_SESSION['tenantID']."' ORDER BY rp.payment_no DESC  ";
$query=mysqli_query($conn,$cart);
while ($rowC=mysqli_fetch_array($query)){
echo '<tr>
<td>'.$rowC['name'].'</td>
<td>'.$rowC['apartment_type'].'</td>
<td>'.$rowC['room_no'].'</td>
<td>'.$rowC['mpesa_code'].'</td>
<td>'.$rowC['cash'].'</td>
<td>'.$rowC['balance'].'</td>
<td>'.$rowC['type_of_payment'].'</td>
<td>'.$rowC['payment_date'].'</td>
<td>';

echo $rowC['payment_status'];


echo '</td>
<td>'.$rowC['payment_remarks'].'</td></td>
<td><form method="post" action="print_reciept.php" >
<input  type="hidden" name="printID"value="'.$rowC['payment_no'].'">
<input type="submit" name="printBtn" value="Print" class="form-control btn-link">
</form>
</td></td>
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