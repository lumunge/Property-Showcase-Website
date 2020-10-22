<?php
error_reporting(E_ERROR||E_PERSER);
session_start();
include("../assets/connection.php");
include("../assets/finalAdmin.php");
$_SESSION['staffusername'];
if (empty($_SESSION['staffusername'])){

header("location:index.php");
}

if (isset($_POST['replyBtn'])){
if (empty($_POST['comment']) ){
$sweet='error';
$feedback="Select a feedback to reply to";


}elseif(empty($_POST['reply'])){

$sweet='error';
$feedback="Please write a Reply";
}else{
$feed_id=$_POST['feed_id'];
$reply=$_POST['reply'];
$update="UPDATE feedback SET reply='$reply' WHERE feed_id='$feed_id' ";
if (mysqli_query($conn,$update)){
$sweet='success';
$feedback='Reply Sent';
$_POST['message']=='';
}
}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">



<title>Feedback</title>
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
<?php
if ($sweet=='error'){
echo '<script>
swal("Error"," '.$feedback.'")
</script>';
}elseif($sweet=='success'){
echo '
<script>
swal("Success","'.$feedback.'");
</script>
';
}
?>
<!-- container section start -->
<section id="container" class="">




<!--main content start-->
<section id="main-content">
<section class="wrapper">            


<div class="row">
<div class="col-md-3 col-lg-3">


<form method="post" >
<input type="hidden" name="feed_id"class="form-control" value="<?php echo $_POST['hiddenID'] ?>">
<lable>Comment</lable><br>

<textarea name="comment" class="form-control" readonly
><?php echo $_POST['comment'];  ?></textarea><br>
<label>Write a Reply</label><br>
<textarea name="reply"class="form-control" ></textarea><br>
<input type="submit" name="replyBtn" value="Send" class="form-control btn-info">	


</form>

</div>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<div class="info-box ">
<div class="form-group pull-right">
<input type="text" class="search form-control btn-warning" placeholder="Search Here?" style="color: black;background-color: white">
</div>
<i class="fa fa-cloud-download"></i>
<div class="count">Pending Feedback</div>

<table class="table table-bordered" style="text-align: center" id="userTbl">

<th>Tenant Name </th>
<th>Username </th>
<th>Comment</th>
<th>Reply</th>
<th>Date</th>
<th>Action</th>


<?php

$SELECT="SELECT * FROM tenants AS t INNER JOIN feedback AS f ON t.username=f.username WHERE reply='Pending'  " ;
$records=mysqli_query($conn,$SELECT);
while($row=mysqli_fetch_array($records)){

echo '<tr>
<td>'.$row['first_name'].' '.$row['last_name'].'  '.$row['middel_name'].'</td>
<td>'.$row['username'].'</td>
<td>'.$row['message'].'</td>
<td>'.$row['reply'].'</td>
<td>'.$row['comment_date'].'</td>
<td><form method="post">
<input type="hidden" name="hiddenID" value="'.$row['feed_id'].'" class="form-control"/>
<input type="hidden" name="comment" value="'.$row['message'].'"class="form-control"/>
<input type="submit" name="selectBtn" value="Select" class="form-control btn-info"/></td>
</form>
</tr>';
}
?>
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
