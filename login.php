<?php
session_start();
error_reporting(E_ERROR);
include("assets/connection.php");
if(isset($_POST["login"])){
unset($_SESSION['success']);
if(empty($_POST["username"]) || empty($_POST["password"])){
$sweet='error';
$feedback= "Please enter both username and password to login";

}else{
$username=$_POST["username"];
$password=$_POST["password"];

$select="SELECT * FROM tenants WHERE username='$username' AND password='$password'";
$query=mysqli_query($conn,$select);
$fetch=mysqli_num_rows($query);
$row=mysqli_fetch_assoc($query);// this will fetch tenant id from tenant table
$status=$row['tenant_status'];

if ($fetch==1){
if($status=='Approved'){
unset($_SESSION['success']);
$sweet='success';
$feedback= "you have logged in";
$_SESSION["tenantID"]=$row['tenant_id'];// session tenant id
$_SESSION['username']=$row['username'];
header("location:profile.php");
}elseif($status=='Pending'){
$sweet='error';
$feedback= "Wait For your account to be approved";
}elseif($status=='Rejected'|| $status=='Deactiveted'){
$sweet='error';
$feedback= "Access to your account has been Delined Please cantactthe admin";
}
}else{
$sweet='error';
$feedback= "Failed to login";
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>| Tenant Login |</title>
 <link rel="stylesheet" href="css/login.css">
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="./FAICO/js/all.min.css">
<link href="css/sweetalert.css" type="text/css" rel="stylesheet" />
<script src="js/sweetalert.js"></script>

</head>

<body>
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
if (!empty($_SESSION['success'])){
echo"<script>
swal('Success',' Wait for account activation')
</script>";
unset($_SESSION['success']);
}
?>

<header class="cont1">
<div class="topper">
<div class="logo">
<a href="index.php">WAKHURA ESTATES</a>
</div>
<div class="bookingCart">
<a href="cart.php"
>Booking Cart <i class="fas fa-shopping-cart"></i
></a>
</div>
</div>
</header>

<nav class="navbar">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button
type="button"
class="navbar-toggle collapsed"
data-toggle="collapse"
data-target="#bs-example-navbar-collapse-1"
aria-expanded="false"
>
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<li><a href="index.php">Home</a></li>
<li><a href="aboutus.php">About Us</a></li>
<li><a href="contactus.php">Contact Us</a></li>
<li><a href="helpuser.php">Help</a></li>

<!-- (php)if (empty($_SESSION['tenantID'])){

}else{
echo '<li class="active"><a href="profile.php"
>My Profile <span class="sr-only">(current)</span></a
>
'; }  -->
</ul>

<ul class="nav navbar-nav navbar-right">
<li><a href="register.php">Create Account</a></li>
<li class="dropdown">
<a
href="#"
class="dropdown-toggle active"
data-toggle="dropdown"
role="button"
aria-haspopup="true"
aria-expanded="false"
>Login <span class="caret"></span
></a>
<ul class="dropdown-menu">
<li><a href="login.php">Tenant</a></li>
<li role="separator" class="divider"></li>
<li><a href="admin/index.php">Staff</a></li>
<li role="separator" class="divider"></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</li>
</ul>
</div>
</div>
</nav>

<div class="container">
<div class="login">
<h1>Tenant Login</h1>

<form method="post" autocomplete="off">
<input type="text" name="username" placeholder="Username" />
<input type="password" name="password" placeholder="Password" />
<button type="submit" name="login">login</button><br />
</form>

<p id="regText">
Dont have an account? <a href="register.php">Register Here.</a>
</p>
</div>
</div>
<script src="./FAICO/js/all.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>
