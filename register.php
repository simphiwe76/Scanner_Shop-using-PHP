<?php

include_once "admin/database/dbConn.php";
session_start();

if (isset($_POST['btnRegister']))
{
        $nameC = mysqli_real_escape_string($conn,ucwords($_POST['name']));
        $custSirname = mysqli_real_escape_string($conn,ucwords($_POST['surname']));
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $pwd = mysqli_real_escape_string($conn,$_POST['password']);
        $cPwd = mysqli_real_escape_string($conn,$_POST['cpassword']);

    if (empty($nameC)&&empty($custSirname)&&empty($gender)&&empty($email)&&empty($pwd)&&empty($cPwd))
    {

      $_SESSION['message'] = "All field are empty";
      $_SESSION['msg_type'] = "danger";
      echo "<script>location.replace('register.php');</script>";
      exit();

    }
    else
    {
            if (!empty($nameC))
            {
                  if (preg_match("/^[a-zA-Z\s]+$/",$nameC))
                  {
                          if (!empty($custSirname))
                          {
                                if (preg_match("/^[a-zA-Z]+$/",$custSirname))
                                {
                                      if (!empty($gender))
                                      {
                                          if (!empty($email))
                                          {
                                              if (filter_var($email, FILTER_VALIDATE_EMAIL))
                                              {
                                                      if (!empty($pwd))
                                                      {
                                                        if (!empty($cPwd))
                                                        {
                                                                if ($cPwd == $pwd)
                                                                {

                                                                  $sql = "SELECT* FROM customer WHERE customerEmail = '$email';";
                                                                  $result = mysqli_query($conn,$sql);
                                                                  $numR = mysqli_num_rows($result);


                                                                  if ($numR>0)
                                                                  {
                                                                    $_SESSION['message'] = "Already have Account with us";
                                                                     $_SESSION['msg_type'] = "danger";
                                                                     echo "<script>location.replace('register.php');</script>";
                                                                     exit();
                                                                  }
                                                                  else
                                                                  {
                                                                    $pwdN = password_hash($cPwd, PASSWORD_DEFAULT);
                                                                    $sql = "INSERT INTO customer (customerName,customerSurname,customerGender,customerEmail,customerPwd)
                                                                            Values('$nameC','$custSirname','$gender','$email','$pwdN')";
                                                                    mysqli_query($conn,$sql);
                                                                    echo '<script>alert("Successfully Registered")</script>';
                                                                    echo "<script>location.replace('login.php');</script>";
                                                                    exit();

                                                                  }


                                                                }
                                                                else
                                                                {
                                                                  $_SESSION['message'] = "Password doesnot match";
                                                                   $_SESSION['msg_type'] = "danger";
                                                                   echo "<script>location.replace('register.php');</script>";
                                                                   exit();
                                                                }
                                                        }
                                                        else
                                                        {
                                                          $_SESSION['message'] = "Confirm Password field is empty";
                                                           $_SESSION['msg_type'] = "danger";
                                                           echo "<script>location.replace('register.php');</script>";
                                                           exit();
                                                        }
                                                      }
                                                      else
                                                      {
                                                        $_SESSION['message'] = "Password field is empty";
                                                         $_SESSION['msg_type'] = "danger";
                                                         echo "<script>location.replace('register.php');</script>";
                                                         exit();
                                                      }
                                              }
                                              else
                                              {
                                                $_SESSION['message'] = "Email is not valid";
                                                 $_SESSION['msg_type'] = "danger";
                                                 echo "<script>location.replace('register.php');</script>";
                                                 exit();
                                              }
                                          }
                                          else
                                          {
                                            $_SESSION['message'] = "Email field is empty";
                                             $_SESSION['msg_type'] = "danger";
                                             echo "<script>location.replace('register.php');</script>";
                                             exit();
                                          }
                                      }
                                      else
                                      {
                                        $_SESSION['message'] = "Select gender";
                                         $_SESSION['msg_type'] = "danger";
                                         echo "<script>location.replace('register.php');</script>";
                                         exit();
                                      }
                                }
                                else
                                {
                                  $_SESSION['message'] = "Surname field must be characters";
                                   $_SESSION['msg_type'] = "danger";
                                   echo "<script>location.replace('register.php');</script>";
                                   exit();
                                }
                          }
                          else
                          {
                            $_SESSION['message'] = "Surname field must is empty";
                             $_SESSION['msg_type'] = "danger";
                             echo "<script>location.replace('register.php');</script>";
                             exit();
                          }
                  }
                  else
                  {
                    $_SESSION['message'] = "Name field must be characters";
                     $_SESSION['msg_type'] = "danger";
                     echo "<script>location.replace('register.php');</script>";
                     exit();
                  }
            }
            else
            {
              $_SESSION['message'] = "Name field are empty";
               $_SESSION['msg_type'] = "danger";
               echo "<script>location.replace('register.php');</script>";
               exit();
            }
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
	<!--	<div class="py-1 bg-black">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+ 1235 2355 98</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">youremail@email.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text">3-5 Business days delivery &amp; Free Returns</span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>-->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Grocery Management System</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.html" class="nav-link">Home</a></li>


            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Register Or Login</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="register.php">Register</a>
                <a class="dropdown-item" href="login.php">Login</a>
              </div>
            </li>


	        </ul>
	      </div>
	    </div>
	  </nav>

    <div class="hero-wrap hero-bread" style="background-image: url('images/img/g1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Customer</a></span> <span>Register</span></p>
            <h1 class="mb-0 bread">Register</h1>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-gallery">
    	<div class="container">
        <br>
        <br>
        <br>
        <br>
    		<div class="row justify-content-center">


          <div class="col-sm-4">

            <form action="register.php" method="post" novalidate="novalidate">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Name</label>
                                    <input type="text" name="name"  class="form-control"  style="border-radius: 50px;"  placeholder="Enter Name">
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Surname</label>
                                    <input type="text" name="surname"  class="form-control"  style="border-radius: 50px;"  placeholder="Enter Surname">
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Email</label>
                                    <input type="email" name="email"  class="form-control"  style="border-radius: 50px;"  placeholder="Enter Email">
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Gender</label>
                                    <select class="form-control"  style="border-radius: 50px;" name="gender">
                                        <option value="">--Select Gender--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Password</label>
                                    <input type="password" id="pwd" name="password"  class="form-control"  style="border-radius: 50px;"  placeholder="Enter password">
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Confirm Password</label>
                                    <input type="password" id="pwdC" name="cpassword"  class="form-control"  style="border-radius: 50px;"  placeholder="Enter Confirm Password">
                                 </div>
                                 <div class="form-group">
                                    <input type="checkbox" name="check"  onclick="showPaword()"  style="border-radius: 50px;"> Show Password
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
                                                 <button class="btn btn-primary py-3 px-4" type="submit" name="btnRegister">Register</button>
                                        </div>

                                        <div class="col-md-12 text-center ">
                                                <a href="login.php">Already have account?</a>
                                        </div>

                            </form>


                            </div>



    		</div>
        <br>
        <br>
        <br>
        <br>
    	</div>



    </section>

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

          <script type="text/javascript">
                function showPaword()
                {
                  var p = document.getElementById("pwd");
                  var pc = document.getElementById("pwdC");

                  if (p.type === "password" && pc.type === "password")
                  {
                      p.type = "text";
                      pc.type = "text";
                  }
                  else
                  {
                    p.type = "password";
                    pc.type = "password";
                  }

                }
          </script>
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
