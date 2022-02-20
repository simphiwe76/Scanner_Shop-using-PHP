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



 $storeId = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Grocery Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

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


	          <li class="nav-item "><a href="index.php" class="nav-link">Home</a></li>

            <li class="nav-item active"><a href="orders.php?type=shop&id=<?php echo $storeId; ?>" class="nav-link">Orders</a></li>
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
<br>
<br>
    <section class="ftco-section ftco-no-pt ftco-no-pb">
      <br>
        <h4 class="text-center">Customer Orders</h4>
      <br>
			<div class="container">
				<div class="row justify-content-center">

          <div class="col-12">
          <div class="card">
          <div class="card-body">
          <?php

             if (isset($_SESSION['message'])): ?>
             <div class="alert alert-<?=$_SESSION['msg_type']?>">

               <?php
                   echo $_SESSION['message'];
                   unset($_SESSION['message']);
               ?>
           </div>
          <?php endif ?>
          <h4 class="card-title">All Order data</h4>
          <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

          <div class="table-responsive m-t-50">
          <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
          <thead>
          <tr>

          <th style="text-align: center;">#Order Number</th>
          <th style="text-align: center;">Order Total</th>
            <th style="text-align: center;">Order Date</th>
            <th style="text-align: center;">Action</th>





          </tr>
          </thead>
          <tbody>
          <?php

          $sql = "SELECT* FROM customerorder WHERE customerID = '$cusID' AND storeID = '$storeId';";
          $result = mysqli_query($conn,$sql);
          $numRow = mysqli_num_rows($result);

          if ($numRow>0)
          {
          while ($row = mysqli_fetch_assoc($result))
          {




          ?>
          <tr>
          <td style="text-align: center;"><?php echo $row['orderNumber']; ?></td>
          <td style="text-align: center;"><?php echo "R".$row['orderTotal']; ?></td>
          <td style="text-align: center;"><?php echo $row['orderDate']; ?></td>


          <td>
              <a class="btn btn-primary" href="items.php?type=itemOrder&id=<?php echo $storeId."&orderID=".$row['orderNumber']; ?>">View Items</a>


          </td>
          </tr>
          <?php


          }

          }


          ?>

          </tbody>
          </table>

          </div>
          </div>
          </div>
          </div>


        </div>
			</div>
		</section>
    <br>
    <br>



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


  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
  <script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ]
    } );

    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
   </script>

  </body>
</html>
