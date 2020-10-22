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
	
		
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Check Out</title>

<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/model.css" rel="stylesheet" type="text/css">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">
<script src="js/sweetalert.js"></script>
<script src="js/jquery.js"></script>
		
	<script src="js/bootstrap.min.js"></script>


</head>

<body>

<div class="jumbotron">
<div class="container">

	<div class="row">
		
		<div class="col-lg-2 col-md-2"></div>
		<div class="col-lg-10 col-md-10">
		<div class="panel panel-primary">
		<div class="panel-heading ">
			<h4 style=""><em>Booking Request Sent successfully, please wait for your request to be approved.
<small><a href="booking_history.php" style="color: white">Click here to view your booking Status</a></small></em></h4>
			<hr/>
			</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>