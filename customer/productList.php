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




if (isset($_SESSION['custID'])&&isset($_SESSION['custEmail']))
{
  if (!isset($_SESSION['budgetAmt']))
  {
    echo '<script>alert("Add Budget Amount first")</script>';
    echo "<script>location.replace('index.php');</script>";
    exit();
  }

  $storeId = $_GET['id'];

  $sql = "SELECT* FROM product WHERE storeID = '$storeId';";
  $result = mysqli_query($conn,$sql);

  $numProduct = mysqli_num_rows($result);

  $cot = 0;
  if (isset($_SESSION['shop_Cart']))
  {
          $cot = count($_SESSION['shop_Cart']);
  }


  if (isset($_POST['btnUpdateBudget']))
  {
        $budgetAmt = $_POST['budget'];

        if (!empty($budgetAmt))
        {
                if (preg_match("/^[0-9.]+$/",$budgetAmt))
                {

                        if (isset($_SESSION['budgetAmt']))
                        {
                            unset($_SESSION['budgetAmt']);
                            $_SESSION['budgetAmt'] = $budgetAmt;

                            $url = "productList.php?type=shop&id=".$storeId;
                            echo "<script>location.replace('$url');</script>";
                            exit();
                        }

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
}
else {

  echo "<script>location.replace('../login.php');</script>";
  exit();
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Grocery Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
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


    <style >
                  html {
                  height: 100%;
                  }

                  body {
                  font-family: sans-serif;
                  padding: 0 10px;
                  height: 100%;

                  margin: 0;
                  }

                  h1 {
                  color: black;
                  margin: 0;
                  padding: 15px;
                  }

                  #container {
                  text-align: center;
                  margin: 0;
                  }

                  #qr-canvas {
                  margin: auto;
                  width: calc(100% - 20px);
                  max-width: 400px;
                  }


                  #btn-scan-qr {
                  cursor: pointer;
                  }


                  #btn-scan-qr img {
                  height: 10em;
                  padding: 15px;
                  margin: 15px;
                  background: white;
                  }


                  #qr-result {
                  font-size: 1.2em;
                  margin: 20px auto;
                  padding: 20px;
                  max-width: 700px;
                  background-color: white;
                  }
      </style>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Update Budget</button>
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>

            <li class="nav-item active"><a href="orders.php?type=shop&id=<?php echo $storeId; ?>" class="nav-link">Orders</a></li>
            <li class="nav-item cta cta-colored"><a href="cart.php?type=shop&id=<?php echo $storeId."&page=product"; ?>" class="nav-link"><span class="icon-shopping_cart"></span>[<?php echo $cot; ?>]</a></li>
            <li class="nav-item active"><a href="logout.php" class="nav-link">Logout</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <section class="ftco-section ftco-no-pt ftco-no-pb">
      <div class="row ">

<div class="col-md-8" >


  <?php



    $sql = "SELECT  P.catagoryID,COUNT(*) AS 'productN',C.catagoryName FROM catagory C ,product P WHERE P.catagoryID = C.catagoryID AND P.storeID = '$storeId' group BY  P.catagoryID";
    $result = mysqli_query($conn,$sql);
    $numR = mysqli_num_rows($result);

    if ($numR>0)
    {
          echo "
          <div class='col-lg-6 py-3'>

          <div class='widget-box'>
          <h4 class='widget-title'>Category</h4>

          <h5 class='widget-title'>Filter By :</h5>
          <div class='divider'></div>
          <ul class='categories'>
          <li><a href='productList.php?type=shop&id=$storeId'>All<span>($numProduct)</span></a></li>
          ";
          while ($row = mysqli_fetch_assoc($result))
          {
                  $n = $row['catagoryName'];
                  $num = $row['productN'];
                  $caID = $row['catagoryID'];
                  echo "


                      <li><a href='productList.php?type=shop&id=$storeId&catType=catFilter&caterID=$caID'>$n<span>($num)</span></a></li>

                  ";

          }
          echo "



          </ul>
          </div>
          </div>
          ";
    }

  ?>
  <br>
  <br>
</div>



<div class="col-md-4">
  <div class='widget-box'>
  <form  class='search-form'   action="productList.php?type=shop&id=<?php echo $storeId; ?>" method="post">
    <div class="input-group rounded">
      <input type="text" name="nSearch"  class="form-control rounded" placeholder="Type a keyword and hit enter" aria-label="Search"
      aria-describedby="search-addon" />
    </div>
    <br>
    <div class="input-group rounded">
          <button class="btn btn-primary" type="submit" name="btnSearch">Search</button>
    </div>

  </form>
    </div>



</div>

</div>
<br>
<br>
        <h4 class="text-center">Product List</h4>
        <br>

			<div class="container">

        <?php
                   if (isset($_SESSION['message'])): ?>
                   <div class="alert alert-<?=$_SESSION['msg_type']?>">

                     <?php
                         echo $_SESSION['message'];
                         unset($_SESSION['message']);
                     ?>
                 </div>
               <?php endif ?>


				<div class="row">



          <?php

              if (isset($_SESSION['custID']))
              {


                    if (isset($_POST['btnSearch']))
                    {
                      $prodSearch = $_POST['nSearch'];
                      $sql = "SELECT* FROM product WHERE storeID = '$storeId' AND productName LIKE '%$prodSearch%';";
                      $result = mysqli_query($conn,$sql);
                      $numR = mysqli_num_rows($result);
                    }
                    elseif (isset($_POST['btnAll']))
                    {
                      $sql = "SELECT* FROM product WHERE storeID = '$storeId';";
                      $result = mysqli_query($conn,$sql);
                      $numR = mysqli_num_rows($result);
                    }
                    elseif (isset($_GET['caterID']))
                    {
                      $ic = $_GET['caterID'];
                      $sql = "SELECT* FROM product WHERE storeID = '$storeId' AND catagoryID = '$ic';";
                      $result = mysqli_query($conn,$sql);
                      $numR = mysqli_num_rows($result);
                    }
                    else
                    {
                      $sql = "SELECT* FROM product WHERE storeID = '$storeId';";
                      $result = mysqli_query($conn,$sql);
                      $numR = mysqli_num_rows($result);
                    }



                    if ($numR > 0)
                    {

                      while ($row = mysqli_fetch_assoc($result))
                      {




          ?>
          <div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
                <form class="" action="manage_cart.php?type=shop&id=<?php echo $storeId."&page=scan"; ?>" method="post">
                <div class="product">
		    					<img class="img-fluid" style="width:300px;height:270px; border-radius: 15px;"  src="../admin/img/<?php echo $row['prodImg']; ?>" alt="Colorlib Template">
			    					<div class="overlay"></div>

		    					<div class="text py-3 pb-4 px-3">
		    						<div class="d-flex">
		    							<div class="cat">
				    						<span>Product Number  <?php echo $row['productNo']; ?></span>
				    					</div>
				    					<div class="rating">
			    							<p class="text-right mb-0">
			    								<a href="#"><span class="ion-ios-star-outline"></span></a>
			    								<a href="#"><span class="ion-ios-star-outline"></span></a>
			    								<a href="#"><span class="ion-ios-star-outline"></span></a>
			    								<a href="#"><span class="ion-ios-star-outline"></span></a>
			    								<a href="#"><span class="ion-ios-star-outline"></span></a>
			    							</p>
			    						</div>
			    					</div>
		    						<h3><a href="#"><?php echo $row['productName']; ?></a></h3>
		  							<div class="pricing">
			    						<p class="price"><span><?php echo "R".$row['productPrice']; ?></span></p>
			    					</div>

                      <button type="submit" class="btn btn-primary" name="add_cart">Add to cart</button>
                      <input class="buy-now text-center py-2" name="quantity" min="1" type="number" name="" value="1">
                      <input type="hidden" name="i" value="<?php echo $row['prodID']; ?>">
                     <input type="hidden" name="item_Name" value="<?php echo $row['productName']; ?>">
                      <input type="hidden" name="item_Price" value="<?php echo $row['productPrice']; ?>">
                      <input type="hidden" name="item_image" value="<?php echo $row['prodImg']; ?>">
                      <input type="hidden" name="dirPage" value="productList.php">
                     <input type="hidden" name="item_Decsription" value="<?php echo $row['productName']; ?>">
                      </form>

		    					</div>
		    				</div>
		    			</div>

              <br>
              <br>
              <?php
                    }
                }
                else
                {


                        echo "<br><br><br><br><br><br><h3 class='text-center'>No Product Found</h3>";


                }
                }
              ?>


        </div>
			</div>
		</section>


<br>
<br>
<br>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Budget</h5>
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


              <form action="productList.php?type=shop&id=<?php echo $storeId; ?>" method="post" novalidate="novalidate">
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
                                                  <button class="btn btn-primary py-3 px-4" type="submit" name="btnUpdateBudget">Update Budget</button>
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

<script src="qrCodeScanner.js"></script>


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
