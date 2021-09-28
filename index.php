<?php
session_start();
error_reporting(E_ERROR);
$_SESSION['username'];
$_SESSION["tenantID"];
include('assets/connection.php');

if (isset($_POST['bookBtn'])) {
    $_SESSION['hiddenApID']=$_POST['hiddenApID'];
    $_SESSION['hiddenname']=$_POST['hiddenname'];

    header('location:cart.php');
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/mainIndex.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="./FAICO/css/all.min.css">
<link rel="stylesheet" href="css/sweetalert.css">
<script src="js/sweetalert.js"></script>
</head>
<body>
<?php
if ($sweet=='error') {
    echo"<script>
swal('Error','".$feedback."')
</script>";
} elseif ($sweet=='success') {
    echo"<script>
swal('Success','".$feedback."')
</script>";
}
?>
<!-- NAVBAR -->
<?php
include('assets/pageNav.php');
?>
<div class="landing">
<img src="./images/GettyImages_619686566.1503067714.jpg" alt="">
<div id="sect">
<i class="cit fas fa-city"></i>
<h1>Welcome to Wakhura Estates</h1>
<p>Available Homes and apartments at the best prices.</p>
<a href="#!" id="cta"><button class="cta">Learn More <i class="fas fa-arrow-right"></i></button></a>
</div>
</div>

<div id="sectionB">
<div class="row">
<div class="gallery">

<?php
$select="SELECT * FROM `apartment` ";
$record=mysqli_query($conn, $select);
while ($row=mysqli_fetch_array($record)) {
    echo '

<div class="col-md-3 col-lg-3 image-responsive">

<div class="thumbnail " style="height:500px;">

<h4>'.$row['name'].'</h4>

<form id="formation" method="POST">
<img width="240" height="240" src="uploadsImg/'.$row['image'].'"class=" image-responsive" >
<p class="tag">'.$row['apartment_type'].'<br></p>
<p class="tag" style="font-size:18px;">'.$row['description'].' <br/></p>';

    if (!empty($_SESSION['tenantID'])) {
        echo '
<input type="hidden" name="hiddenApID" value="'.$row['apartment_id'].'">
<input type="hidden" name="hiddenname" value="'.$row['name'].'">

<input id="bookBtn" type="submit" name="bookBtn" value="Book" class="form-control btn-info">
</form>';
    } else {
        echo '
<a href="#!" id="learner"><button>Learn More <i class="fas fa-arrow-right"></i></button></a>

</form>';
    }
    echo '</div></div>';
}
?>
</div>
</div>
</div>


<!-- Copyrights Section -->
<footer id="footer">
<div class="topper">
<div class="logo">
<a href="index.php">Wakhura Estates</a>
</div>
<div class="retop">
<a href="#!"> <i class="far fa-arrow-alt-circle-up"></i> Return to Top</a>
</div>
</div>
<hr>
<div class="midder">
<div class="about">
	<p>About</p>
<a href="#!">Privacy Policy</a>
<a href="#!">Privacy Rights</a>
<a href="#!">Ads</a>
<a href="#!">Terms Of Use</a>
<a href="#!">Our Company</a>
<a href="#!">Careers</a>
</div>
<div class="connect ">
	<p>Socials</p>
	<a href="#!"><i class="fas fa-at"></i> Email </a>
	<a href="#!"><i class="fab fa-facebook"></i> Facebook </a>
	<a href="#!"><i class="fab fa-instagram"></i> Instagram </a>
	<a href="#!"><i class="fab fa-twitter"></i> Twitter </a>
	<a href="#!"><i class="fab fa-pinterest"></i> Pinterest </a>
	<a href="#!"><i class="fab fa-google-plus"></i> Google </a>
</div>
<div class="contacts">
	<p>Contacts</p>
	<a href="#!">Customer Care</a>
	<a href="#!">NewsRoom</a>
	<a href="#!">Locations</a>
</div>
<div class="subscribe">
	<p>Subscribe</p>
	<a href="#!">Newsletter</a>
	<a href="">eEdition Demo</a>
	<a href="">Mobile App</a>
</div>
</div>
<div class="lachu">
<p>All rights Reserved &copy; Copyrights 2020 wakhuraestates</p>
</div>
</footer>
<script src="./FAICO/js/all.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
