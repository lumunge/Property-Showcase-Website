<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "rentals");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$username = mysqli_real_escape_string($link, $_REQUEST['username']);
$message = mysqli_real_escape_string($link, $_REQUEST['message']);
 
// Attempt insert query execution
$sql = "INSERT INTO feedback (username, message) VALUES ('$username', '$message')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reply Messages.</title>
  <!-- sweet alert  -->
<link rel="stylesheet" href="css/sweetalert.css">
<script src="js/sweetalert.js"></script>
<script src="js/jquery.js"></script>
<link rel="stylesheet" href="css/all.min.css" />
<style>
body{
  background: #fff;
}
</style>
</head>
<body>
<?php
// $sweet = "";
if($sweet == 'error'){
    echo "<script>swal('Error', '".$feedback."')</script>";
}elseif($sweet == 'success'){
    echo "<script>swal('Success', '".$feedback."')</script>";
}
?>
<a href="index.php">DashBoard
  <br><i class="fa fa-arrow-left fa-4x"></i></a>
</body>
</html>

