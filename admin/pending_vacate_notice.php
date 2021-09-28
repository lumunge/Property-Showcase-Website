<?php
session_start();

include('../assets/connection.php');
include('../assets/finalAdmin.php');
error_reporting(E_ERROR||E_PERSER);

if (isset($_GET['assignBtn'])){
	 $noticeID=$_GET['noticeID'];
	$staffID=$_GET['staffID'];
	$roomID=$_GET['roomID'];
$insert="INSERT INTO inspection_report(notice_id,staff_id,room_id,inspection_report,fine)VALUES('$noticeID','$staffID','$roomID','Pending','N/A')";
	mysqli_query($conn,$insert);
	
	$update="UPDATE vacate_notice SET vacate_status='Confirmed Pending Approval',vacate_remarks='Apartment pending inspection' WHERE notice_id='$noticeID'";
			if (mysqli_query($conn,$update)){
				$sweet='success';
				$feedback='Submited Successfully';
			}
		
}

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title>Pending Vacate notice</title>

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
            <div class="col-md- 1 col-lg-1"></div>
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
					<div class="info-box  ">
										<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
</div>
					<div class="col-md-5">
						<div class=""><h4>Pending Vacate notice</h4></div></div>
		       <div class="col-md-4 col-lg-4 col-sm-4">
		      
		       
		       	<?php
				   if (isset($_GET['selectBtn'])){
					   echo 'Select staff to inspect the Apartment ';
					   echo '<form method="get" autocomplete="off">
					   <select name="staffID" class="form-control btn-defualt">';
					    echo'<option></option> ';
					  $select="SELECT * FROM staff WHERE userlevel='staff'";
					   $record=mysqli_query($conn,$select);
					   while($rowS=mysqli_fetch_array($record)){
						  ?>
				<option value=<?php echo $rowS['staff_id'] ?> ><?php echo $rowS['username'] ?></option> ';
				   <?php
					   }
					   ?>
					   	</select><br>
                        
		<input type="hidden" name="noticeID" value="<?php echo $_GET['noticeID'] ?>">
		<input type="hidden" name="roomID" value="<?php echo $_GET['roomID'] ?>">
                         <input type="submit"name="assignBtn" value="Submit" class="form-control btn-primary btn-sm">
					   </form>
					<?php
					  }
					   ?> 
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
	
	<th>Tenant Name</th>
	<th>Username</th>
	<th>Apartment</th>
	<th>Room No</th>
	<th>Apartment Type</th>
	<th>Vacate Date</th>
	<th>Reason</th>
	<th>Status</th>
	<th>Action</th>
	</thead>
	<tbody>


<?php
	
	$select="SELECT * FROM vacate_notice AS v INNER JOIN tenants AS t on v.tenant_id=t.tenant_id RIGHT JOIN rooms AS r ON v.room_id=r.room_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id WHERE v.vacate_status='Pending Approval' ";
	$record=mysqli_query($conn,$select);
	while($row=mysqli_fetch_array($record)){
		echo '
		<tr><form method="get">
		<td>'.$row['first_name'].'  '. $row['last_name'].' </td>
		<td>'.$row['username'].'</td>
		<td>'.$row['name'].'</td>
		<td>'.$row['room_no'].'</td>
		<td>'.$row['apartment_type'].'</td>
		<td>'.$row['vacate_date'].'</td>
		<td>'.$row['vacate_reason'].'</td>
		<td>'.$row['vacate_status'].'</td>
		<td> 
		<input type="hidden" name="noticeID" value="'.$row['notice_id'].'">
		<input type="hidden" name="roomID" value="'.$row['room_id'].'">
		<input type="submit" name="selectBtn" value="Select" class="btn btn-primary btn-sm"></td>
		</form>
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
