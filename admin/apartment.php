 <?php
session_start();
error_reporting(E_ERROR);
$_SESSION["staffusername"];
//$_SESSION['userlevel'];

include("../assets/connection.php");
include("../assets/finaladmin.php");
if (empty($_SESSION['staffusername'])){
	header("location:index.php");
}
// insert apartment======================

		if (isset($_POST['saveBtn'])){
		
	if (empty($_POST['apname'] ) || empty($_POST['location']) || empty($_POST['apartmentType'])|| empty($_POST['rent']) || empty($_POST['desc']) || empty($_FILES['image']['name'])){
		$sweet='error';
		$feedback='Fill in all the details';
	}else{
		// check if apartment name already exists in the db
		$apname=$_POST['apname'];
		$selc="SELECT * FROM apartment WHERE ap_name='$apname'";
		$query=mysqli_query($conn,$selc);
		$check=mysqli_num_rows($query);
		
		
		if ($check >0){
			// if name exist 
			$sweet='error';
			$feedback='Apartment '.$_POST['apname'].' exists in the System';
		}else{
			
		// insert if apartment name does not exist
		
		$apname=$_POST['apname'];
		$location=$_POST['location'];
		$apartType=$_POST['apartmentType'];
		$rent=$_POST['rent'];
		$desc=$_POST['desc'];
		$image=$_FILES['image']['name'];
		$target="../uploadsImg/".basename($_FILES['image']['name']);
         
		$insert="INSERT INTO `apartment` (`apartment_id`, `name`, `location`,  `description`, `apartment_type`, `rent`,`image`) VALUES (NULL, '$apname', '$location','$desc', '$apartType',  '$rent', '$image')";
		move_uploaded_file($_FILES['image']['tmp_name'],$target);
		if (mysqli_query($conn,$insert)){
			$sweet='error';
			 $feedback='Apartmant added successfuly';
		}else{
			$sweet='error';
			 $feedback='there was an error. failed to save';
		}
	}
	}
	}
	

	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title> Apartments</title>

   	 
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
	  <style>
	@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
		  .sub{
			background-color: blue;
			color: white;
		}
	  </style>
  <style>
		.sub{
			background-color: blue;
			color: white;
		}
	  </style>
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
	
	<?php
				if ($_SESSION['userlevel']=='Staff'){
					
				}else{
					?>
					<form method="post" enctype="multipart/form-data" autocomplete="off" >
	<label>Apartmant Name</label>
	<input type="text" name="apname" class="form-control">
	<label>Location</label>
	<input type="text" name="location" class="form-control">
	<label>Type of Apartment</label>
	<select name="apartmentType" class="form-control">
		<option></option>
		<option>Singles</option>
		<option>BedSitters</option>
		<option>Apartments</option>
	</select>
	<label>Rent</label>
	<input type="text" name="rent" class="form-control">
	<label>Description</label>
	<textarea name="desc" class="form-control"></textarea>
	<label>Apartment Image</label>
	<input type="file" name="image" class="form-control"><br/>
	<input type="submit" name="saveBtn" value="Save" class="form-control btn-success">
</form>
					
					<?php
				}
				?>


            </div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<div class="info-box ">
											<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
</div>
						<div class="count"> Apartments</div>
						                       <!---Print script==========================-->
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
<div class="hidden-print">
	<thead class="no-print">
	<th>Apartment Name</th>
	<th>Type</th>
	<th>Rent</th>
	<th>Location</th>
	<th>Details</th>
	<th>Image</th>
	<?php
		if ($_SESSION['userlevel']=='Staff'){
					
				}else{
					?>
				<th>Action</th>
					<?php
		}
		?>
	
	</thead></div>
	<tbody>	
	<?php
	
	$select ="SELECT * FROM apartment";
		$record=mysqli_query($conn,$select);
	while ($row=mysqli_fetch_array($record)){
		echo '
		<tr>
		</td>
		<td>'.$row['name'].'</td>
		<td>'.$row['apartment_type'].'</td>
		<td>'.$row['rent'].'</td>
		<td>'.$row['location'].'</td>
		<td>'.$row['description'].'</td>
		<td><img width="80" height="80" src="../uploadsImg/'.$row['image'].'"  type="video/mp4"></td>
	<td>	<form method="post" action="edit_apartment.php" >
		<input type="hidden" name="apHiddenID" value="'.$row['apartment_id'].'" class="btn-info"/>';
		
		if ($_SESSION['userlevel']=='Staff'){
					
				}else{
					
		echo '<input type="submit" name="editBtn" value="Edit" class="form-control btn-info hidden-print"/>
		</form>';
		}
	echo '
		</td>
		</tr>		
		';
	}
	?>
	</tbody>
</table>
						</div>
							<script>
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
>>>>>>>>>>>>>>>>>>>>