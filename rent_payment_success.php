<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
	// header('location:login.php');
	
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Payment Success</title>
<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">
<script src="js/sweetalert.js"></script>
<script src="js/jquery.js"></script>
		
		<script src="js/bootstrap.min.js"></script>


</head>

<body>
<?php
	if(!empty($_SESSION['rentPay'])){
		
		echo'
		<script>
		swal(""," Rent Payment successful");
		</script>
		';
		
		$_SESSION['rentPay']=''; //destroy the session;
	}
	?>

<div class="container">

			<h2 style="text-align: center"><em>Success</em></h2>
			<hr/>
	<div class="row">

		<div class="col-lg-1 col-md-1"></div>
		
		<div class="col-lg-11 jumbotron btn-info">
		<p> Payment successful! Your rent due date will be update once payment has been confirmed by the admin.</p>
		<a href="profile.php"><button class="btn form-group btn-danger">Back to profile</button></a>
		</div>
		
		
	</div>




</div>
</body>
</html>