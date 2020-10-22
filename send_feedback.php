<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');
if (empty($_SESSION['username'])){
// header('location:login.php');
}

$username = $message = $sweet = "";

if (isset($_POST['submitBtn'])){
$username=$_POST['username'];
$message=$_POST['message'];
$insert="INSERT INTO feedback (username, message, reply)VALUES('".$_SESSION['username']."','$message', 'Pending')";
if(mysqli_query($conn,$insert)){
$_SESSION['message']='success';
header('location:feedback_history.php');
}else{
$sweet='error';
$feedback='Failed to send feedback';
}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Send Feedback</title>
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
<div class="col-lg-1 col-md-1">

<a href="profile.php" class="btn btn-primary btn-sm">Back to profile</a>
</div>
<div class="col-lg-1 col-md-1">


</div>
<div class="col-lg-1 col-md-1">

<a href="feedback_history.php" class="btn btn-primary btn-sm">Feedback History</a>
</div>
<div class="col-lg-12 col-md-12">
<h2 style="text-align: center"><em>Send Feedback</em></h2>
<hr/>
</div>
<div class="col-lg-4 col-md-4">
<form method="post">
<textarea class="form-control" name="message"required></textarea><br>
<input type="submit" name="submitBtn" value="Send" class="btn btn-sm btn-primary">

</form>
</div>
<div class="col-lg-4">

<h4>WAKHURA ESTATES HEADQUATERS</h4>
<h4>P.O. Box 120-60200</h4>
<h4>Nairobi, Kenya.</h4>
<h4>Phone +254735526890</h4>


</div>
<div class="col-lg-4">
<h4>Wakhura Estates Secretary office</h4> 
<h4>Email: wakhuraestates@gmail.com</h4>
<h4>Contact Centre: +254709241000</h4>		
</div>
<div class="col-lg-4"></div>
</div>
</div>
</div>

</body>
</html>