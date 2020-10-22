<?php
session_start();
error_reporting(E_ERROR);
 $_SESSION['username'];
 $_SESSION["tenantID"];
include('assets/connection.php');
include('assets/pageNav.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>| Our Contacts |</title>
    <link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>
  </head>

  <body style="background-color: #fff;">
    <div class="container">
      <h1 align="center">
        <strong><em style="color: #333;">CONTACT US TODAY.</em></strong>
      </h1>
      <hr />
      <div style="text-align: center;">
        <h4>WAKHURA ESTATES</h4>
        <h4>P.O. Box 120-60200</h4>
        <h4>PHONE: +254735662789</h4>
        <h4>NAIROBI, Kenya.</h4>
      <br>
      <br>
      <br>
      
        <h4>Town Secretary office</h4>
        <h4>Email: wakhuraestatesmain@gmail.com</h4>
        <h4>PHONE: +254709241000</h4>
    </div>
  </body>
</html>
