<?php
session_start();
error_reporting(E_ERROR);
include('assets/connection.php');
include('assets/pageNav.php');

if (empty($_SESSION['tenantID'])){
// header('location:login.php');
}
if (isset($_POST["buttonUpdate"])){
if (empty($_POST["firstname"])){
$sweet='error';
$feedback="First Should not be empty";
}else{
$firstname=$_POST["firstname"];
if (empty($_POST["lastname"])){
$sweet='error';
$feedback= "Last name should not be empty";
}else{
$lastname=$_POST["lastname"];
if(empty($_POST["middlename"])){
$sweet='error';
$feedback=  "Middle Name should not be empty";
}else{
$middlename=$_POST["middlename"];

if (empty($_POST["username"])){
$sweet='error';
$feedback= "Please enter a username";
}else{
$username=$_POST["username"];
if(empty($_POST["phoneno"])){
$sweet='error';
$feedback= "Phone number should not be empty";
}else{
$phoneno=$_POST["phoneno"];
if(empty($_POST["idno"])){
$sweet='error';
$feedback=  "ID number should not be empty";
}else{
$id=$_POST["idno"];
if(empty($_POST["email"])){
$sweet='error';
$feedback=  "Email should not be empty";
}else{
$email=$_POST["email"];
if(empty($_POST["password"])){
$sweet='error';
$feedback= "Phone number should not be empty";
}else{
$password=$_POST["password"];

$Update="UPDATE `tenants` SET `first_name`='$firstname', `middle_name`='$middlename',`last_name`='$lastname',`username`='$username',
`phone_no`='$phoneno',`id_no`='$id',`email`='$email',`password`='$password' WHERE `tenant_id`='".$_SESSION["tenantID"]."'";

if(mysqli_query($conn,$Update)){
$sweet='success';
$feedback='Profile Update successfuly';
header("location:profile.php");
}else{
$sweet='success';
$feedback='Failed to update profile';
}
}
}

}
}
}
}
}
}
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Tenant Edit Profile</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="css/sweetalert.css" type="text/css" rel="stylesheet">
<link href="css/edit_profile.css" type="text/css" rel="stylesheet">
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

<div class="container">
<div class="row"  >
<div class="col-lg-4 col-md-4">
<a href="profile.php" class="btn">Back to profile</a>
</div>
<div id="cover" class="col-md-2 col-lg-2 col-sm-12">
<?php
$select="SELECT * FROM tenants WHERE tenant_id='".$_SESSION['tenantID']."'";
$record=mysqli_query($conn,$select);
$row=mysqli_fetch_array($record);
?>
<form method="post" autocomplete="off">
<label >First Name</label>
<input type="text" name="firstname" class="form-control" value="<?php echo $row['first_name']  ?>">
</div> 
<div id="cover" class="col-md-2 col-lg-2 col-sm-12"  >
<label>Last Name</label>
<input type="text" name="lastname"  class="form-control"value="<?php echo $row['last_name'] ?>">
</div> 	
</div> 
<div class="row" >
<div class="col-lg-4 col-md-4">

</div>
<div id="cover" class="col-md-3 col-lg-4 col-sm-12" >
<label> Middle Name</label>
<input type="text" name="middlename" class="form-control" value="<?php echo $row['middle_name'] ?>">
<label>Username</label>
<input type="text" name="username" class="form-control"value="<?php echo $row['username'] ?>">
<label>Phone No</label>
<input type="text" name="phoneno" class="form-control" value="<?php echo $row['phone_no'] ?>">
<label>National ID No</label>
<input type="text" name="idno" class="form-control" value="<?php echo $row['id_no'] ?>">
<label>Email</label>
<input type="text" name="email" class="form-control" value="<?php echo $row['email'] ?>">
<label>Password</label>
<input type="password" name="password" class="form-control" value="<?php echo $row['password'] ?>"><br/>
<input type="submit" name="buttonUpdate" value="Update Account" class="form-control btn">
<br/>
</form>

</div>

</div>
</div>

</div>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>