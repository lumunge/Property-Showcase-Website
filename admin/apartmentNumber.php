<?php
session_start();
error_reporting(E_ERROR);
$_SESSION["staffusername"];
//$_SESSION['userlevel'];
include("../assets/connection.php");

//include("../assets/finalAdmin.php");

if (empty($_SESSION['staffusername'])){
	header('location:index.php');
}

if (isset($_POST['saveBtn'])){

	
	
	if (empty($_POST['apertName'])||  empty($_POST['apartmentNo']) ){
		$sweet='error';
		$feedback='Please fill in all the details';
	}else{
		// get apartment id from apertment table using the option apartment name
		$apartName=$_POST['apertName'];
		$slt="SELECT * FROM `apartment` WHERE `name`='$apartName'";
		$get=mysqli_query($conn,$slt);
		$rowId=mysqli_fetch_assoc($get);
		 $rowId['apartment_id']; // apartment id 
		

		
		// Check if apartment room number already exist in the system
		
		$apartmentNo=$_POST['apartmentNo'];
		$apartId=$rowId['apartment_id']; // apertment id
		$selct1="SELECT * FROM rooms WHERE `apartment_id`=$apartId AND `room_no`='$apartmentNo' ";
		$get2=mysqli_query($conn,$selct1);
		$check=mysqli_num_rows($get2);
		
		if ($check >0){
			$sweet='error';
			$feedback='Room' .' '.$apartmentNo.' '.  'For'.' ' . $apartName.' '. 'Exists In the system';
			
			
		}else{
			
	
		
		// insert into table apartment_no after getting the apartment Id 
		
		$insert="INSERT INTO `rooms` (`room_id`, `apartment_id`, `room_no`,  `room_status`) VALUES (NULL, '$apartId', '$apartmentNo', 'Empty')";
			if (mysqli_query($conn,$insert)){
				$sweet='success';
				$feedback= 'Recored saved successfuly';
			}else{
				$sweet='error';
				$feedback='Error: Failed to save';
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
    
 

    <title> Apartment No</title>

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
  
   <style>
		.sub{
			background-color: white;
			
		}
	  </style>
  </head>

  <body class=" dark-bg">
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
  
     
      
       
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
            
              
            <div class="row">
            <div class="col-md-3 col-lg-3">
            	
<?php
	if ($_SESSION['userlevel']=='Staff'){
					
				}else{
					?>
					
		
					
					
					
					<form method="post" autocomplete="off">

	<lable>Apertment Name</lable>
	<select name="apertName" class=" form-control" >
		<option><?php echo $_POST['apertName'] ?></option>
		<?php
		// get the apartemt name from apartment table
		$selct="SELECT * FROM apartment";
			$name=mysqli_query($conn,$selct);
		while($rowN=mysqli_fetch_array($name)){
			
			echo '<option>'.$rowN['name'].'</option>';
		}
		?>
	</select>
	
	<lable>Type of apertment</lable>
	
	<label>Room NO</label>
	<input type="text" name="apartmentNo" class="form-control"><br/>
	<input type="submit" name="saveBtn" value="Save" class="form-control btn-success">
	

</form>
					<?php
	}
	?>
	
	


            </div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<div class="info-box ">
						<i class="fa fa-cloud-download"></i>
						<div class="count"> Room No
						<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
							</div>
						</div>
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
<table class="table table-bordered" id="userTbl"  style="text-align: center">
	<thead>
	<th>Apartment Name</th>
	<th>Type</th>
	<th>Room No</th>
	<th>Rent</th>
	<th>Status</th>
	</thead>
	<tbody>
	<?php
	$select="SELECT * FROM rooms AS r INNER JOIN apartment AS a ON a.apartment_id=r.apartment_id ORDER BY `a`.`name` ASC ";
	$record=mysqli_query($conn,$select);
	while ($row=mysqli_fetch_array($record)){
		
		echo '
		<tr>
		<td>'.$row['name'].'</td>
		<td>'.$row['apartment_type'].'</td>
		<td>'.$row['room_no'].'</td>
		<td>'.$row['rent'].'</td>
		<td>'.$row['room_status'].'</td>
		
		
		</tr>';
		
	}
	
	?>
	
	
	</tbody>
</table>		
						</div>									<script>
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
