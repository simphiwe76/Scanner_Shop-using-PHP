<?php
include_once "../admin/database/dbConn.php";
session_start();

if (!isset($_SESSION['custID'])&&!isset($_SESSION['custEmail'])) {
  $_SESSION['message'] = "Please Login folks!!!";
   $_SESSION['msg_type'] = "danger";
  echo "<script>location.replace('../login.php');</script>";
  exit();
}



 $cusID= $_SESSION['custID'];
 $cusEmail = $_SESSION['custEmail'];


 if (isset($_SESSION['shop_Cart']))
 {
          unset($_SESSION['shop_Cart']);
 }

 if (isset($_SESSION['payS']))
 {
       unset($_SESSION['payS']);

 }

if (isset($_POST['btnBudget']))
{
      $budgetAmt = $_POST['budget'];

      if (!empty($budgetAmt))
      {
              if (preg_match("/^[0-9.]+$/",$budgetAmt))
              {
                      unset($_SESSION['budgetAmt']);
                      $_SESSION['budgetAmt'] = $budgetAmt;
              }
              else
              {
                echo '<script>alert("Budget Amount must be digit")</script>';
                echo "<script>location.replace('index.php');</script>";
                exit();
              }
      }
      else
      {
        echo '<script>alert("Budget Amount field is empty")</script>';
        echo "<script>location.replace('index.php');</script>";
        exit();
      }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Grocery Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="goto-here">

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Grocery Management System</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Budget</button>


	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="view.php">View</a>
                <a class="dropdown-item" href="update_profile.php">Update</a>
                  <a class="dropdown-item" href="profile_delete.php">Delete</a>
              </div>
            </li>

            <li class="nav-item active"><a href="logout.php" class="nav-link">Logout</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
      <br>
      <br>
      <br>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
      <br>
        <h3 class="text-center">Select Store</h3>
        <?php

                   if (isset($_SESSION['message'])): ?>
                   <div class="alert alert-<?=$_SESSION['msg_type']?>">

                     <?php
                         echo $_SESSION['message'];
                         unset($_SESSION['message']);
                     ?>
                 </div>
               <?php endif ?>
      <br>
			<div class="container">
				<div class="row justify-content-center">
          <?php
            $sql = "SELECT* FROM store";
            $result = mysqli_query($conn,$sql);
            $numR = mysqli_num_rows($result);

              if($numR>0)
              {
                while ($row=mysqli_fetch_assoc($result))
              {

          ?>
          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-4 py-md-5">
              <div class="icon d-flex justify-content-center align-items-center mb-4">

              </div>
              <div class="media-body">
                <h3 class="heading"><?php echo $row['storeName']; ?></h3>

                <p><a href="chooseType.php?type=shop&id=<?php echo $row['storeID']; ?>" class="btn-custom">
<img style="width:300px;height:270px; border-radius: 15px;" src="<?php echo "storeImg/".$row['storeName'].".png"; ?>" class="img-responsive" alt="">

                </a></p>
              </div>
            </div>
          </div>
          <?php
       }
      }
      else
      {
                    echo "<h2 class='text-center'>No Store Available</h2>";
      }
      ?>
        </div>
			</div>
		</section>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Budget</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <br>
              <br>
              <br>
              <br>
              <div class="row justify-content-center">

                  <div class="col-12">


                  <form action="index.php" method="post" novalidate="novalidate">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Budget Amount</label>
                                          <input type="email" name="budget"  class="form-control"  style="border-radius: 50px;"  placeholder="Enter Budget">
                                       </div>

                                       <div class="form-group">
                                          <p></p>
                                       </div>
                                       <?php

                                                  if (isset($_SESSION['message'])): ?>
                                                  <div class="alert alert-<?=$_SESSION['msg_type']?>">

                                                    <?php
                                                        echo $_SESSION['message'];
                                                        unset($_SESSION['message']);
                                                    ?>
                                                </div>
                                              <?php endif ?>
                                              <div class="col-md-12 text-center ">
                                                      <button class="btn btn-primary py-3 px-4" type="submit" name="btnBudget">Add Budget</button>
                                              </div>



                                  </form>




                </div>

              </div>
              <br>
              <br>
              <br>
              <br>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>






    <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Grocery Management System</h2>
              <p>A digital system aimed to integrate different types of stores into one, for the purpose of selling to
                consumers.</p>

            </div>
          </div>
        <!--  <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Shop</a></li>
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Journal</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Help</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
	                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
	                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
	              </ul>
	              <ul class="list-unstyled">
	                <li><a href="#" class="py-2 d-block">FAQs</a></li>
	                <li><a href="#" class="py-2 d-block">Contact</a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>-->
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Grocery Management System can't be removed. Template is licensed under CC BY 3.0.
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script>
               All rights reserved | <i class="icon-heart color-danger" aria-hidden="true"></i>
               by <a href="#" target="_blank">Grocery Management System</a>-->
						  <!-- Link back to Grocery Management System can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
          </div>
        </div>
      </div>
    </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

  </body>
</html>
