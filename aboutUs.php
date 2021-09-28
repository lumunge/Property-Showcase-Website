<?php
session_start();
error_reporting(E_ERROR);
 $_SESSION['username'];
 $_SESSION["tenantID"];
include('assets/connection.php');
// include('assets/pageNav.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>| About Us |</title>
    <link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/about.css" />
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>
  </head>

  <body style="background-color: #fff">
    <?php
include('assets/pageNav.php');
?>
    <h1 align="center">
      <strong><em style="color: white"> WAKHURA ESTATES</em></strong>
    </h1>

    <div class="container">
      <div class="jumbotron">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <p></p>
            <h4>Vision</h4>
            <p>A Green United Prosperous Rentals and Apartments</p>

            <h4>Mission</h4>
            <p>
              To facilitate sustainable development and wealth creation in the
              County through commerce, technological innovations and
              industrialization that leverages on our skilled human resources,
              agriculture, wildlife, bio-diversity and cultural heritage
            </p>

            <h4>Core Values</h4>
            <p>
              We are committed to upholding the following core values as the
              guiding principles for the operations of the county:
            </p>
            <ul>
              <li>
                <strong>Integrity: </strong>Honesty and sincerity are an
                integral part of our operations. We shall uphold these through
                strict adherence to the moral principles underlying all our
                policies.
              </li>
              <li>
                <strong>Transparency and Accountability:</strong> We shall
                always endeavour to be transparent, answerable and liable at all
                times.
              </li>
              <li>
                <strong>Team work:</strong> We treat one another with respect
                and communicate openly. We create a workplace that fosters
                community, respects, and uniqueness of each person, promotes
                employee participation to ensure their full contribution and
                appreciate the value of multiple perspectives and diverse
                expertise
              </li>
              <li>
                <strong>Inclusiveness:</strong> In all our undertakings, we
                shall ensure inclusiveness; the county shall have people from
                diverse backgrounds or communities involved in the development.
                The county is learning-centred that value the perspectives and
                contributions of all people, and it incorporates the needs,
                assets, and perspectives of communities into the design and
                implementation of county programs. All groups and members of the
                county shall be treated equally and without exception
              </li>
              <li>
                <strong>Innovativeness:</strong> We thrive on creativity and
                ingenuity. We seek the innovations and ideas that can bring a
                positive change to the basin. We value creativity that is
                focused, data-driven, and continuously-improving based on
                results.
              </li>
              <li>
                <strong>Hardworking:</strong> We shall be patriotic to the cause
                of the county and be guided by hardworking ethics in all our
                undertakings
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <footer id="footer">
      <div class="topper">
        <div class="logo">
          <a href="index.php">Wakhura Estates</a>
        </div>
        <div class="retop">
          <a href="#!">
            <i class="far fa-arrow-alt-circle-up"></i> Return to Top</a
          >
        </div>
      </div>
      <hr />
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
        <div class="connect">
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
  </body>
</html>
