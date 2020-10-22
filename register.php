<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');

if (isset($_POST['buttonsave'])){
if (empty($_POST['firstname'])||empty($_POST['lastname']) ||empty($_POST['middlename']) ||empty($_POST['username']) ||empty($_POST['phoneno']) ||empty($_POST['idno']) ||empty($_POST['email']) ||empty($_POST['password']) ){
$sweet='error';
echo $feedback="Fill in all the details";
}else{

if(!preg_match ('/^([a-zA-Z]+)$/', $_POST['firstname'])){
$sweet='error';
$feedback='Invalid First name. Enter only  Letters';
}elseif(!preg_match ('/^([a-zA-Z]+)$/', $_POST['lastname'])){
$sweet='error';
$feedback='Invalid Last name. Enter only  Letters';
}elseif(!preg_match ('/^([a-zA-Z]+)$/', $_POST['middlename'])){
$sweet='error';
$feedback='Invalid middle name. Enter only  Letters';
}elseif(!preg_match ('/^([a-zA-Z]+)$/', $_POST['username'])){
$sweet='error';
$feedback='Invalid Username. Enter only  Letters';

} elseif(!is_numeric($_POST['phoneno'])) {
$sweet='error';
$feedback="Phone No should contain numbers only";
}elseif(strlen($_POST['phoneno'])<> 10){
$sweet='error';
$feedback="Phone No should have 10 digit";
}else{
if (!is_numeric($_POST['idno'])){
$sweet='error';
$feedback='ID No should contain numbers only';
}elseif(strlen($_POST['idno'])<>8){
$sweet='error';
$feedback='ID No should have 8 digits';
}else{
//check for valid email 
if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$_POST['email'])){
$sweet='error';
$feedback= 'Email Address is not Valid';
}else{
if ( strlen($_POST['password'])<4 ){
$sweet='error';
$feedback='Password have more than 4 characters';
}else{


$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$middlename=$_POST['middlename'];
$username=$_POST['username'];
$phoneno=$_POST['phoneno'];
$idno=$_POST['idno'];
$email=$_POST['email'];
$password=$_POST['password'];
// Check if username already in use
$check="SELECT * FROM tenants WHERE username='$username'";
$sql=mysqli_query($conn,$check);
$get=mysqli_num_rows($sql);

if ($get==1){
$sweet='error';
$feedback= 'Username Already In use!! Please Use another Username';

}else{

// Check if phone no already in use 
$check="SELECT * FROM tenants WHERE phone_no='$phoneno'";
$sql=mysqli_query($conn,$check);
$get=mysqli_num_rows($sql);
if ($get==1){
$sweet='error';
$feedback= 'Phone no Already In use!! Please Use another Username';

}else{
$insert="INSERT INTO `tenants` (`first_name`, `middle_name`, `last_name`, `username`, `phone_no`, `id_no`, `email`, `password`) VALUES ('$firstname', '$middlename', '$lastname', '$username', '$phoneno', '$idno', '$email', '$password')";
if(mysqli_query($conn,$insert)){
$sweet='success';
$feedback='Account created';
$_SESSION['success']='success';
$_SESSION['username']=$_POST['username'];
unset($_SESSION["tenantID"]);
header('location:login.php');
}else{
$sweet='error';
echo $feedback='Failed to create account';
}

}
}

}}
}

}
}
} 
?> 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>| Tenant Registartion Form |</title>
<link rel="stylesheet" href="css/registerClient.css" />
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="./FAICO/css/all.min.css" />
<link rel="stylesheet" href="css/sweetalert.css" />
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

<div class="contain">
<h1>New Tenant Registartion Form</h1>
<form method="POST" autocomplete="off">
<div id="names" class="row">
<div class="col-lg-4 col-md-4"></div>
<div id="holder" class="col-md-2 col-lg-2 col-sm-12">
<label id="label">First Name</label>
<input
type="text"
name="firstname"
class="form-control"
value="<?php echo $_POST['firstname']  ?>"
/>
</div>
<div id="holder" class="col-md-2 col-lg-2 col-sm-12">
<label>Last Name</label>
<input
type="text"
name="lastname"
class="form-control"
value="<?php echo $_POST['lastname'] ?>"
/>
</div>
</div>

<div class="row">
<div class="col-lg-4 col-md-4" style="background-color: #333;"></div>
<div id="restBdy"
class="col-md-3 col-lg-4 col-sm-12"
>
<label> Middle Name</label>
<input
type="text"
name="middlename"
class="form-control"
value="<?php echo $_POST['middlename'] ?>"
/>

<label>Username</label>
<input
type="text"
name="username"
class="form-control"
value="<?php echo $_POST['username'] ?>"
/>

<label>Phone No</label>
<input
type="text"
name="phoneno"
class="form-control"
value="<?php echo $_POST['phoneno'] ?>"
/>

<label>National ID No</label>
<input
type="text"
name="idno"
class="form-control"
value="<?php echo $_POST['idno'] ?>"
/>

<label>Email</label>
<input
type="text"
name="email"
class="form-control"
value="<?php echo $_POST['email'] ?>"
/>

<label>Password</label>
<input
type="password"
name="password"
class="form-control"
value="<?php echo $_POST['password'] ?>"
/><br />

<button id="creator" type="submit" name="buttonsave">Create Account</button>
<h3>
Already have an account? <a href="login.php">Login Here.</a>
</h3>
<br />
</div>
</div>
</form>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
