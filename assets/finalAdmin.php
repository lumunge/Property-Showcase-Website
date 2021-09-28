<?php
// error_reporting(E_ERROR);

// $newAccounts = "SELECT * FROM tenants WHERE tenant_status='Pending'";
// $rec = mysqli_query($conn, $newAccounts);
// $noNewAcc = mysqli_num_rows($rec);


// $SELECT = "SELECT fb.fb_id, fb.tenant_id, fb.comment, fb.reply, fb.staff_id, fb.date, t.tenant_id,t.username FROM feedback AS fb INNER JOIN tenants AS t WHERE fb.tenant_id=t.tenant_id AND fb.reply='Pending' " ;
// $records = mysqli_query($conn, $SELECT);
// $fbpending = mysqli_num_rows($records);


// $selsct = "SELECT * FROM rent_payment AS rp INNER JOIN rooms AS r ON rp.room_id=r.room_id RIGHT JOIN tenants AS t ON rp.tenant_id=t.tenant_id RIGHT JOIN apartment AS a ON r.apartment_id=a.apartment_id RIGHT JOIN bookings AS b ON r.room_id=b.room_id WHERE rp.payment_status='Pending Approval' AND rp.type_of_payment='Booking Payment'";
// $records = mysqli_query($conn, $selsct);
// $bkpending = mysqli_num_rows($records);

// $select = "SELECT * FROM `rent_payment`  WHERE payment_status='Pending Approval'";
// $query = mysqli_query($conn, $select);
// $rentPay = mysqli_num_rows($query);

// $ct = "SELECT * FROM `feedback`  WHERE reply='Pending'";
// $reply = mysqli_query($conn, $ct);
// $fbReply = mysqli_num_rows($reply);


// $select = "SELECT * FROM `vacate_notice` WHERE vacate_status='Pending Approval'    ";
// $query = mysqli_query($conn, $select);
// $vacatePending = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/favicon.png">
<style>
*{
margin: 0;
padding: 0;
box-sizing: border-box;
}
.header{
display: flex;
flex-flow: row wrap;
justify-content: space-around;
align-items: center;
background-color: #333;
padding: 1.5rem 2rem;
}
.logo a{
color: #FFA500;
font-family: cursive;
text-decoration: none;
font-weight: 500;
font-size: 2rem;
}
.header .navy a{
color: #FFA500;
text-decoration: none;
font-size: 1.5rem;
font-family: cursive;
padding: 0 .7rem;
}
.header .top-nav a{
color: #FF6347;
text-decoration: none;
font-size: 1.2rem;
font-family: cursive;
padding: 0 .7rem;
}
.header .logo a:hover,
.header .navy a:hover,
.header .top-nav a:hover{
    color: #fff;
    transition: all .2s ease-in-out;
    border-top: .3px solid yellow;
}

</style>
<link rel="stylesheet" href="../FAICO/css/all.min.css">
</head>

<body>
<!--header start-->
<header class="header">

<div class="toggle-nav">
<div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
</div>

<!--logo start-->
<div class="logo">
<a href="../admin/apartment_details.php"> JUNO ESTATES </a>
</div>
<!--logo end-->

<div class="navy search-row" id="top_menu">
<a href="pending_accounts.php">New Accounts  <?php echo $noNewAcc ?> //</a>   
<a href="booking_payment.php">New Bookings  <?php echo $bkpending ?> //</a>   
<a href="pending_rent_payment.php">New Rent Payment <?php echo $rentPay ?> //</a>   
<a href="new_feedback.php"">Pending Feedback <?php echo $fbReply; ?> //</a>
<?php
if ($_SESSION['userlevel']=='Staff') {
} else {
    ?>
<a href="pending_vacate_notice.php">Vacate Notice <?php echo $vacatePending ?></a>
<?php
}
?>
</div>

<!-- <div class="top-nav notification-row">     
<ul>
<li><a href="help.php" style="color: white">Help</a> </li>
</ul>
</div> -->

<div class="top-nav notification-row">     
<a href="#"><i class="fa fa-print" aria-hidden="true"></i><span onclick="printDiv('printableArea')"> Print</span></a>
</div>

<div class="top-nav notification-row">     
<a href="logout.php"> <i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

</header>  
</section>    
<!--header end-->

<!--sidebar start-->
<aside class="table-responsive">
<div id="sidebar"  class="nav-collapse "> 
<!-- sidebar menu start-->
<ul class="sidebar-menu" style="color: white">                
<li class="active">
<a class="" href="apartment_details.php">
<i class="icon_house_alt"></i>
<span>Admin Dashboard</span>
</a>
</li>
<li class="active">
<a class="" href="apartment.php">
<i class="icon_house_alt"></i>
<span>Apartment</span>
</a>
</li>
<li class="active">
<a class="" href="apartmentNumber.php">
<i class="icon_house_alt"></i>
<span>Apartment Number</span>
</a>
</li>

<li class="active">
<a class="" href="approved_booking_payment.php">
<i class="icon_house_alt"></i>
<span>Booking Payment</span>
</a>
</li>
<li class="active">
<a class="" href="approved_rent_payment.php">
<i class="icon_house_alt"></i>
<span>Rent Payment</span>
</a>
</li>
<li class="active">
<a class="" href="approved_fine_payment.php">
<i class="icon_house_alt"></i>
<span>Fine Payment</span>
</a>
</li>
<li class="active">
<a class="" href="pending_vacate_notice.php">
<i class="icon_house_alt"></i>
<span>Vacate notice</span>
</a>
</li>
<?php
if ($_SESSION['userlevel']=='Staff') {
    echo '<li class="active">
<a class="" href="staff_pending_inspection.php">
<i class="icon_house_alt"></i>
<span>Apartment To Inspect</span>
</a>
</li> ';
} else {
    echo '<li class="active">
<a class="" href="inspected_apartments.php">
<i class="icon_house_alt"></i>
<span>Apartment Inspection</span>
</a>
</li>
<li class="active">
<a class="" href="refunded_booking_payment.php">
<i class="icon_house_alt"></i>
<span>Refunds</span>
</a>
</li>
<li class="active">
<a class="" href="staff.php">
<i class="icon_house_alt"></i>
<span>staff</span>
</a>
</li>
';
}
?>
<li class="active">
<a class="" href="feedback.php">
<i class="icon_house_alt"></i>
<span>Feedback</span>
</a>
</li>

</ul>
<!-- sidebar menu end-->
</div>
</aside>
<!--sidebar end-->  
<div class="text-right">
<div class="credits">


</div>
</div>
</section>





<script src="../FAICO/js/all.min.js"></script>
</body>
</html>
