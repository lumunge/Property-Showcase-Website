<?php
session_start();
error_reporting(E_ERROR||E_PERSER);
$_SESSION["staffusername"];
//$_SESSION['userlevel'];

include("../assets/connection.php");
include("../assets/finalAdmin.php");
include('../assets/connection.php');
if (empty($_SESSION['staffusername'])){
	header('location:index.php');
}
// insert new record
if (isset($_POST['saveBtn'])){
	if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['username']) || empty($_POST['password']) ){
		$sweet='error';
		 $feedback=" ERROR!! Fill in all the feilds";
		
	}else{
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$insert="INSERT INTO `staff` (`staff_id`, `first_name`, `last_name`, `username`, `password`, `userlevel`, `staff_status`) VALUES ('Null', '$firstname', '$lastname', '$username', '$password', 'Staff', 'Approved')";
		if (mysqli_query($conn,$insert)){
			$sweet='success';
			 $feedback="Account Created";
			
		}else{
			$sweet='error';
			 $feedback="ERROR!! Failed to create Account ";
		}
	}
}
// update account
if (isset($_POST['statusBtn'])){
	if(empty($_POST['status'])){
		$sweet='error';
		 $feedback='ERROR!! Please Select a status Option';
		
	}else{
		$status=$_POST['status'];
		$staffId=$_POST['staffId'];
		$update="UPDATE staff SET staff_status='$status' WHERE staff_id='$staffId'";
		if (mysqli_query($conn,$update)){
			$sweet='success';
			 $feedback="Status Update";
		}else{
			$sweet='error';
			 $feedback="ERROR!! Failed To update Status";

		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title> Staff</title>

    <link href="../css/adminNav.css" rel="stylesheet">
   <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
  <script src="../js/jquery.js"></script>
	  <script src="../js/bootstrap.min.js"></script>
	  
	  
	   <!-- javascripts -->
    <script src="../js/sweetalert.js"></script>
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
  
  </head>

  <body class=" dark-bg">
  <!-- container section start -->
  <section id="container" class="">
     
      
       
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
            
              
            <div class="row">
            <div class="col-md-3 col-lg-3">
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
<form method="post" autocomplete="off">
<label>First Name</label>
<input type="text" name="firstname" class="form-control">
	<label>Last Name</label>
<input type="text" name="lastname" class="form-control">
<label>Username</label>
<input type="text" name="username" class="form-control">
<label>Password</label>
<input type="password" name="password" class="form-control">
<br>
<input type="submit" name="saveBtn" value="Save" class="form-control btn-success">
</form>

            </div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<div class="info-box ">
						<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
</div>
						<div class="count"> Staff</div>
			       <script>
		function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
		</script> 
                      <!---END Print script==========================-->
                      
                      
                      <!-----PRint Area========---->
					 <div id="printableArea">			
<table class="table table-bordered" id="userTbl" style="text-align: center">
	<thead>
	<th>Name</th>
	<th>Username</th>
	<th>Status</th>
	<th>Action</th>
	</thead>
	<tbody>
	<?php
	$select="SELECT * FROM staff WHERE userlevel='Staff'";
	$record=mysqli_query($conn,$select);
	while ($row=mysqli_fetch_array($record)){
		
		echo '
		<tr><form method="post">
		<td>'.$row['first_name'].' '.$row['last_name'].' <input type="hidden" name="staffId" value="'.$row['staff_id'].'"></td>
		<td>'.$row['username'].'</td>
		<td>'.$row['staff_status'].'</td>
		<td><select name="status" class="form-control">
		<option></option>
		<option>Approved</option>
		<option>Rejected</option>
		</select>
		<input type="submit" name="statusBtn" value="Update" class="form-control btn-info"></td>
		</form>
		</tr>';
		
	}
	
	?>
	
	</tbody>
	
</table>		
						</div>					<script>
$(document).ready(function(){
    $('.search').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#userTbl tbody tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });
});
</script>	
					</div><!--/.info-box-->			
				</div><!--/.col-->
				
				
			
           <div class="row"></div>  
            
		  
		  <!-- Today status end -->
			
              
				
			<div class="row"><!--/col--><!--/col--><!--/col-->
				
              </div>

                    
                   
                <!-- statics end -->
              
            
				

              <!-- project team & activity start -->
          <div class="row"></div><br><br>
		
		<div class="row"></div> 
              <!-- project team & activity end -->

          </section>
          <div class="text-right">
         
        </div>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

   
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});

  </script>

  </body>
</html>
