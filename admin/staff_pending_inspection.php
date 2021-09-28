<?php
session_start();
error_reporting(E_ERROR||E_PERSER);

include('../assets/connection.php');
include('../assets/finalAdmin.php');

if (isset($_GET['reportBtn'])){
$hinpectionID=$_GET['hinpectionID'];
 $hnoticeID=$_GET['hnoticeID'];
	$fine=$_GET['fine'];
	$report1=$_GET['report'];
			$update2="UPDATE vacate_notice SET vacate_status='Inspected',vacate_remarks='Inspection Report Sent' WHERE notice_id='$hnoticeID'";

	if(mysqli_query($conn,$update2)){
		
	$update="UPDATE inspection_report SET  fine='$fine',inspection_report='$report1',inspection_status='Inspected', inspection_date=CURRENT_TIMESTAMP WHERE inspection_id='$hinpectionID' ";
		mysqli_query($conn,$update);
		$sweet='success';
		$feedback="Report Sent";
	}else{
				$sweet='error';
		$feedback="Failed to send report";
	}
}




if(isset($_GET['selectBtn'])){
	$report='<form method="get" autocomplete="off">
	<h5>Apartment Name: '.$_GET['happName'].'</h5>
	<h5>Room No: '.$_GET['hroomNo'].'</h5>
	<input type="hidden" name="hinpectionID"  value="'.$_GET['hinspectID'].'">
	<input type="hidden" name="hnoticeID"  value="'.$_GET['hnoticeID'].'" class="btn-info">
	<label>Fine</label>
	<input type="number" name="fine" min="0"value="'.$_GET['fine'].'" class="form-control" required>
	<label>Write A report</label>
	<textarea name="report" class="form-control" required></textarea><br/>
	<input type="submit" name="reportBtn" class="btn btn-md btn-primary" value="submit report">
	
	</form>';
		
}

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title>Pending inspection</title>

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

  <body class=" dark-bg">
  <!-- container section start -->
  
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
  <section id="container" class="">
     
      
       
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
            
              
            <div class="row">
            <div class="col-md- 1 col-lg-2">
            	<?php
				echo $report;
				?>
            </div>
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
					<div class="info-box  ">
										<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
</div>
					<div class="col-md-3">
						<div class=""><h4>Pending Inspection</h4></div>
	      </div>
	      <div class="col-md-6">
<a href="staff_pending_inspection.php"><button class="btn btn-primary btn-sm btn-primary">Pending Inspection</button></a>
	      	   <a href="staff_inspections.php"><button class="btn btn-primary btn-sm btn-primary">Inspected Apartment</button></a>
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
<table  id="userTbl" class="table table-bordered"> 
	<thead>
	
	<th>Apartment</th>
	<th>Room No</th>
	<th>Apartment Type</th>
	<th>Location</th>
	<th>Status</th>
	<th>Action</th>
	</thead>
	<tbody>


<?php
	
	$select="SELECT * FROM inspection_report AS ir INNER JOIN rooms AS r ON ir.room_id=r.room_id LEFT JOIN apartment AS a ON r.apartment_id=a.apartment_id WHERE ir.staff_id='".$_SESSION['staffID']."' AND ir.inspection_status='Pending'";
	$record=mysqli_query($conn,$select);
	while($row=mysqli_fetch_array($record)){
		echo '
		<tr>
		<td>'.$row['name'].'
		</td>
		
		<td>'.$row['room_no'].'</td>
		<td>'.$row['apartment_type'].'</td>
		<td>'.$row['location'].'</td>
		<td>'.$row['inspection_status'].'</td>
		<td><form method="get">
		<input type="hidden" name="hinspectID" value="'.$row['inspection_id'].'">
		<input type="hidden" name="hnoticeID" value="'.$row['notice_id'].'">
		<input type="hidden" name="happName" value="'.$row['name'].'">
		<input type="hidden" name="hroomNo" value="'.$row['room_no'].'">
		<input type="submit" name="selectBtn" value="Select" class="btn btn-sm btn-primary">
		</form>
		</td>
		
		</tr>
		';
		
	}
	
	?>
	</tbody>
</table >
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
