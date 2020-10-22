<?php
session_start();
error_reporting(E_ERROR);
include('../assets/connection.php');
include('../assets/finalAdmin.php');

if (isset($_POST['editBtn'])){
		$_SESSION['apID']=$_POST['apHiddenID'];
		
	}
if (isset($_POST['updateBtn'])){
		if (empty($_POST['apName'] ) || empty($_POST['location']) || empty($_POST['apType'])|| empty($_POST['rent']) || empty($_POST['apDesc']) ){
		
		$feedback='Fill in all the details';
			$sweet='error';
	}else{
	$hiddenID=$_POST['hiddenID'];
	$apName=$_POST['apName'];
	$apType=$_POST['apType'];
	$location=$_POST['location'];
	$apDesc=$_POST['apDesc'];
	$rent=$_POST['rent'];
			
			$update="UPDATE `apartment` SET `name`='$apName',`location`='$location',`description`='$apDesc',`apartment_type`='$apType',`rent`='$rent' WHERE  `apartment_id`='$hiddenID' ";
			if (mysqli_query($conn,$update)){
				$sweet='success';
					$feedback='Apartment Update';
				//	header("location:apartment.php");
			}else{
				$sweet='error';
				$feedback='Failed to Update';
			
				
			}
}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Apartment</title>

   <link href="../css/adminNav.css" rel="stylesheet">
   <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <script src="../js/jquery.js"></script>
	  <script src="../js/bootstrap.min.js"></script>
	  
	  
	   <!-- javascripts -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery knob -->
    <script src="../js/jquery.knob.js"></script>
    <!--custome script for all page-->
    <script src="../js/scripts.js"></script>
    <script>

      //knob
      $(".knob").knob();

  </script>
   <link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
   <script src="../js/sweetalert.js"></script>
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
<div class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4"></div>
			<div class="col-lg-4 col-md-4">
			<?php
				$select="SELECT * FROM apartment WHERE apartment_id='".$_SESSION['apID']."'";
				$query=mysqli_query($conn,$select);
				$row=mysqli_fetch_assoc($query);
				?>
				<form method="post" autocomplete="off" style="margin-top: 10%">
					<label>Apartment Name</label>
					<input type="hidden" name="hiddenID" value="<?php echo $row['apartment_id'] ?>" class="form-control">
					<input type="text" name="apName" value="<?php echo $row['name'] ?>" class="form-control">
					<label>Apartment Type</label>
					 <select name="apType" class="form-control">
					 	<option><?php echo $row['apartment_type'] ?></option>
					 	<option>BedSitter</option>
					 	<option>Single</option>
					 	<option>Apartment</option>
					 </select>
					<label>Location</label>
					<input type="text" name="location" value="<?php echo $row['location'] ?>" class="form-control">
					<label>Apartment Description</label>
					<input type="text" name="apDesc" value="<?php echo $row['description'] ?>" class="form-control">
					<label>Rent</label>
					<input type="text" name="rent" value="<?php  echo $row['rent'] ?>" class="form-control"><label>Apartment Name</label>
					<input type="submit" name="updateBtn" value="Update"  class="form-control btn-info">
				
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>