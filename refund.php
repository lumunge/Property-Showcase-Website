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
<title>Tenant Refunds</title>
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
if($_SESSION['success']=='success'){
echo"<script>
swal('Success','".$_SESSION['refund']." Has been sent to your Safaricom Mpesa Account')
</script>";
$_SESSION['success']='';
}
?>

<div class="col-lg-1 col-md-1"></div>
<div class="col-lg-11 col-md-11">
<h2 style="text-align: center"><em>Refund</em></h2>
<a href="profile.php" class="btn btn-primary btn-sm">Back to profile</a>
<hr/>
<table class="table table-bordered" id="mytable">
<th>Apartment Name</th>
<th>Type</th>
<th>Room No</th>
<th>Deposit</th>
<th>Rent</th>
<th>Balance</th>
<th>Due Date</th>
<th>Vacate Date</th>
<th>Months Remaining</th>
<th>Refund</th>
<th>Refund Status</th>
<th>Action</th>

<?php
$select="SELECT * FROM vacate_notice AS vn INNER JOIN rooms AS r ON vn.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN bookings as b ON vn.booking_id=b.booking_id  WHERE b.booking_status='Vacated' AND vn.tenant_id='".$_SESSION['tenantID']."' ORDER BY notice_id DESC";
$query=mysqli_query($conn,$select);
while ($rowC=mysqli_fetch_array($query)){
echo '<tr>
<td>'.$rowC['name'].'</td>
<td>'.$rowC['apartment_type'].'</td>
<td>'.$rowC['room_no'].'</td>
<td>'.$rowC['rent_deposit'].' Ksh</td>
<td>'.$rowC['rent'].' Ksh</td>
<td>'.$rowC['rent_balance'].' Ksh</td>
<td>'.$dueDate=date('d-m-Y',strtotime($rowC['rent_due_date']));
echo'</td>
<td>'. $vacateDate = date('d-m-Y',strtotime($rowC['vacate_date']));
echo '</td>
';
echo '<td>';
// culculate days left
$due = date_create($dueDate);
$vacateD = date_create($vacateDate);
$count = date_diff($due,$vacateD);
//count days
$diff=$count->format("%a");
// culculate rent to refund
$rentPerDay=  $rowC['rent']/31;// rent per day
// rent per day times days remaining
$rentRefund= $diff *  $rentPerDay;
// total refundable rent remaining plus deposite
/*$refund=$rentRefund+$rowC['rent_deposit'];*/
$mths=round(($diff-30)/30);
if($mths>0){
echo $mths;
}else{
echo 'No months remainig';
}
echo '</td>';								
echo '<td>';
if($mths>0){
echo $refund= ( $rowC['rent']+$rowC['rent_deposit']* $mths)+$rowC['rent_balance'];
}else{
echo $refund=$rowC['rent_deposit']+$rowC['rent_balance'];
}
/*.round($refund)*/
echo ' Ksh</td>';								
echo '<td>';
if ($rowC['deposit_status']=='Refunded'){
echo ' <em style="color:blue;font-size:1.2em"> </em>Refund has been Sent to your Mpesa account';
}else{
echo $rowC['deposit_status'];
}
echo '</td>
<td>';
echo '<form method="post" action="print_refund.php">
<input type="hidden" name="hbookID" value="'.$rowC['booking_id'].'">
<input type="submit"value="Print"name="printBtn" class="btn btn-sm btn-link">
</form>';
echo '</td></tr>';
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