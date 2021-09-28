<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Tenant Profile</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="css/sweetalert.css" type="text/css" rel="stylesheet">
<link href="css/profile.css" type="text/css"rel="stylesheet">
<script src="js/sweetalert.js"></script>
</head>
<body>

<div class="container">
<div class="row"  >
<div class="col-lg-6 col-md-6 table-responsive" ->

<a href="index.php" class="btn btn-primary btn-sm">Book Apartment</a>

<table class="table table-bordered">
<th colspan="2" style="text-align: center">My Profile</th>
<?php 
$select="SELECT * FROM tenants WHERE tenant_id='".$_SESSION['tenantID']."'";
$record=mysqli_query($conn,$select);
while ($row=mysqli_fetch_array($record)){
echo '
<tr>
<td><b>Name </b></td> <td>'.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].' </td></tr>
<tr><td><b>Username </b></td> <td>'.$row['username'].' </td></tr>
<tr><td><b>ID No </b></td> <td>'.$row['id_no'].' </td></tr>
<tr><td><b>Phone No </b></td> <td> '.$row['phone_no'].'</td></tr>
<tr><td><b>Email </b></td> <td>'.$row['email'].' </td></tr>';
}
?>
</table>

</div>
<div class="col-md-4 col-lg-4" style="background-color: aliceblue"><br>

<a href="edit_profile.php"><button class="form-control btn">Edit My profile </button></a><br/>
<a href="booking_history.php"><button class="form-control btn">My Bookings</button></a><br/>
<a href="rent_payment_history.php"><button class="form-control btn">Payment History </button></a><br/>
<a href="rented_houses.php"><button class="form-control btn">Rented Apartments  </button></a><br/>
<a href="send_feedback.php"><button class="form-control btn">Send Feedback</button></a><br/>
<a href="refund.php"><button class="form-control btn">Refund </button></a><br/>
<a href="logout.php" class="btn form-control btn-log" value="Log Out">Log Out</a><br/>
</div>
</div> 
</div>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>