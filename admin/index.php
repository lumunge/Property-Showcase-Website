<?php
session_start();
include("../assets/connection.php");
error_reporting(E_ERROR||E_PERSER);

if (isset($_POST["loginBtn"])){
if(empty($_POST['staffusername']) OR empty($_POST['password'])  ){
$sweet='error';
$feedback="Please enter both username and password";
}else{
$username=$_POST["staffusername"];
$password=$_POST["password"];

$check = "SELECT * FROM staff WHERE username='$username' AND password='".$password."'  ";

$query=	mysqli_query($conn,$check);
$check=	mysqli_num_rows($query);
$row=mysqli_fetch_assoc($query);
$row['userlevel'];
$row['staff_id'];
if ($check==1)	{

if ($row['userlevel']=='Admin'){
unset($_SESSION['userlevel']);
$_SESSION["staffusername"] = $_POST["staffusername"];

header("Location: apartment_details.php");
}
if ($row['userlevel']=='Staff'){
if ($row['status']=='Inactive'){
$sweet='error';
$feedback="A/c deactivated Please contact the Admin";

}else{
$_SESSION['userlevel']=$row['userlevel'];
$_SESSION['staffID']=$row['staff_id'];
header("Location: apartment_details.php");
}
}
}else{
$sweet='error';
$feedback="Failed To Sign In Wrong Username or Password";
}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/bootstrap-theme.css" rel="stylesheet">
<link href="../css/adminNav.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">
<script src="../js/sweetalert.js">	</script>
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

<div class="container">
<a href="../index.php"><button class="btn btn-primary btn-md">Back to home</button></a>
<form  method="post" class="login-form" autocomplete="off" >        
<div class="login-wrap">
<p class="login-img"><i class="icon_lock_alt"></i></p>
<div class="input-group">
<span class="input-group-addon"><i class="icon_profile"></i></span>
<input type="text" name="staffusername" class="form-control" placeholder="Username" autofocus>
</div>
<div class="input-group">
<span class="input-group-addon"><i class="icon_key_alt"></i></span>
<input type="password" name="password" class="form-control" placeholder="Password">
</div>
<button class="btn btn-primary btn-lg btn-block" name="loginBtn" type="submit">Login</button>
</div>
</form>
</div>
</body>
</html>
