<?php
error_reporting(E_ERROR||E_PERSER);
session_start();
include("../assets/connection.php");
include("../assets/finalAdmin.php");
 $_SESSION['appTenant'];
$_SESSION['staffusername'];
if (empty($_SESSION['staffusername'])){

	header("location:index.php");
}





?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 

    <title>Empty apartments</title>

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
  </head>

  <body class=" dark-bg">
  <!-- container section start -->
  <section id="container" class="">
     
      
       
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
            
              
           
            	


				<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
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
	
	            <?php
	echo'<h3>'. $_SESSION['apartmentName'].'  Empty Rooms</h3>';
	?>
                                             				<div class="form-group pull-right">
    <input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
</div>
                                              <thead>      
                                          	<th>Apartment Name</th>
                                          	
                                          	<th>Apartment Type</th>
                                          	<th>Room No</th>
                                          	
                                          	<th>Status</th>
                                          	</thead>   
                                          	<tbody>
                                          	<?php
	 $select="SELECT * FROM apartment AS a INNER JOIN rooms AS r ON a.apartment_id=r.apartment_id WHERE NOT r.room_status='Booked'AND r.apartment_id='".$_SESSION['hiddenAppID']."' ";
														   $query=mysqli_query($conn,$select);
	                                                      
														   while($rowR=mysqli_fetch_array($query)){
															   echo '
															   
															 <tr>
														 <td>'.$rowR['name'].'</td>
														 <td>'.$rowR['apartment_type'].'</td>
														 <td>'.$rowR['room_no'].'</td>
														<td>'.$rowR['room_status'].'</td>
															   
															   </tr>
															   ';
															   
															   }
															   
											   
													   ?>
                                          	</tbody>
                                          </table>
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
