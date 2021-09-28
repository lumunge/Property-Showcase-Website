<?php
error_reporting(E_ERROR||E_PERSER);
session_start();
include("../assets/connection.php");
include("../assets/finalAdmin.php");


if (isset($_POST['tenantBtn'])){
echo $_SESSION['appTenant']=$_POST['hiddenAppID'];
echo $_SESSION['apartmentName']=$_POST['apartmentName'];
echo '<script>
location.href="apartments_tenants.php"
</script>';
}
if (isset($_POST['emptyBtn'])){
$_SESSION['hiddenAppID']=$_POST['hiddenAppID'];
$_SESSION['apartmentName']=$_POST['apartmentName'];
echo '<script>
location.href="empty_apartments.php"
</script>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>| Administrator Dashboard |</title>
<link href="../css/adminNav.css" rel="stylesheet">
<link rel="stylesheet" href="../FAICO/css/all.min.css">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<!-- container section start -->
<section id="container" class="">
<!--main content start-->
<section id="main-content" >
<section class="wrapper">            
<div class="col-lg-12">
<a href="tenants.php">  <input type="submit" value="Tenanats" class="btn btn-md btn-info"></a>
<a href="subscribers.php"> <input type="submit" name="" value="Subscribers" class="btn btn-md btn-info"></a>
<a href="partially_approved_booking.php"> <input type="submit" name="" value="Partially Approved" class="btn btn-md btn-danger"></a>
<a href="pending_deposit_refunds.php"> <input type="submit" name="" value="Deposit Refund" class="btn btn-md btn-info"></a>
</div>
<?php
$slct="SELECT * FROM apartment";
$qry=mysqli_query($conn,$slct);
while($row=mysqli_fetch_array($qry)){
echo ' <div class="col-lg-3 col-md-3 table-responsive" >
<h4 align="center">'.$row['name'].'</h4>
<form method="post">
<input type="hidden" name="hiddenAppID" value="'.$row['apartment_id'].'" class="btn-warning"/>
<input type="hidden" name="apartmentName" value="'.$row['name'].'" class="btn-warning"/>
<input type="hidden" name="empty" value="Empty" class="btn-warning"/>
<input type="hidden" name="empty" value="Empty" class="btn-warning"/>
<input type="hidden" name="booked" value="Booked" class="btn-warning"/>
<input type="submit" name="tenantBtn" value="Tenants/ Booked Rooms" class="form-control btn-info"><br/>
<input type="submit" name="emptyBtn" value="Empty Rooms" class="form-control btn-info"><br/>
</form>
</div>  ';
}
?>

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
<script src="../FAICO/js/all.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>

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
