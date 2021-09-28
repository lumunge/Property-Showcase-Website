<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="pageNav.css" />
    <link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      header {
        margin: 0;
        padding: 0;
        height: 10vh;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
      }
      header .topper {
        display: flex;
        flex-flow: row wrap;
        justify-content: space-around;
        align-items: center;
      }
      .topper .logo {
        margin: 0 auto;
        padding: 1rem;
      }
      .topper .logo a {
        color: #1e90ff;
        font-weight: 600;
        font-size: 3rem;
        text-align: center;
        text-decoration: none;
      }
      .topper .bookingCart {
        position: absolute;
        right: 20px;
      }
      .topper .bookingCart a {
        color: #1e90ff;
        font-weight: 500;
        text-decoration: none;
      }
      .topper .logo a:hover,
      .topper .bookingCart a:hover {
        color: #ff6347;
        transition: all 0.5s ease-in-out;
      }
      .topper .bookingCart {
        float: right;
      }
      .navbar {
        background-color: rgba(0, 0, 0, 0.5);
        margin-bottom: 0px;
        width: 100%;
        z-index: 600;
      }
      .navbar-header .icon-bar {
        background-color: #fff;
      }
      .navbar-nav li a {
        color: #fff;
        font-weight: 600;
        font-size: 2rem;
        border-right: 0.5px solid #000;
      }
      .navbar-nav li a:hover {
        color: #ff6347;
        transition: all 0.5s ease-in-out;
        background-color: transparent;
      }
    </style>
  </head>

  <body>
    <header class="cont1">
      <div class="topper">
        <div class="logo">
          <a href="index.php">JUNO ESTATES</a>
        </div>
        <div class="bookingCart">
          <a href="cart.php"
            >Booking Cart <i class="fas fa-shopping-cart"></i
          ></a>
        </div>
      </div>
    </header>

    <nav class="navbar">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1"
            aria-expanded="false"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- navigation -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
            <li><a href="helpuser.php">Help</a></li>

            <!-- (php)if (empty($_SESSION['tenantID'])){

}else{
echo '<li class="active"><a href="profile.php"
>My Profile <span class="sr-only">(current)</span></a
>
'; }  -->
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="register.php">Create Account</a></li>
            <li class="dropdown bg-dark">
              <a
                href="#"
                class="dropdown-toggle active"
                data-toggle="dropdown"
                role="button"
                aria-haspopup="true"
                aria-expanded="false"
                >Login <span class="caret"></span
              ></a>
              <ul class="dropdown-menu" style="background-color: #333">
                <li><a href="login.php">Tenant</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="admin/index.php">Staff</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
