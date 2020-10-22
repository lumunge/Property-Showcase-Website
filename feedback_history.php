<?php
session_start();
error_reporting(E_ERROR);
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

<title>Feedback History</title>
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
   
	if ($_SESSION['feedback']=='success'){
	 echo"<script>
      swal('Success','Feedback sent','success');
        </script>";
		$_SESSION['feedback']='';
	}
	
	?>
		<div class="col-lg-1 col-md-1">
			
			<a href="profile.php" class="btn btn-primary btn-sm">Back to profile</a>
		</div>
		<div class="col-lg-6 col-md-6">
			<h2 style="text-align: center"><em>Feedback History</em></h2>
			<hr/>
			
			<table class="table table-bordered" id="mytable">
				<td>Message</td>
				<td>Reply</td>
				<td>Date</td>
				<?php
				
				$select="SELECT * FROM feedback WHERE username='".$_SESSION['username']."' ";
				$query=mysqli_query($conn,$select);
				while ($rowC=mysqli_fetch_array($query)){
					echo '<tr>
					<td>'.$rowC['message'].'</td>
					<td>'.$rowC['reply'].'</td>
					<td>'.$rowC['comment_date'].'</td>
					</tr>';
				}
				?>
			</table>

			
		</div>
	</div>
</div>

</body>
</html>