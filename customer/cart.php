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
 $page = $_GET['page'];

 $cot = 0;
 if (isset($_SESSION['shop_Cart']))
 {
         $cot = count($_SESSION['shop_Cart']);
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
	          <li class="nav-item "><a href="index.php" class="nav-link">Home</a></li>

              <?php
                  if ($page == "scan")
                  {
                      echo "<li class='nav-item active'><a href='scanner/scanProduct.php?type=shop&id=$storeId' class='nav-link'>Back To Scanner</a></li>";

                  }
                  elseif($page == "product")
                  {

                    echo "<li class='nav-item active'><a href='productList.php?type=shop&id=$storeId' class='nav-link'>Back To Menu</a></li>";
                  }

              ?>

            <li class="nav-item cta cta-colored"><a href="cart.php?type=shop&id=<?php echo $storeId."&page=". $page; ?>" class="nav-link"><span class="icon-shopping_cart"></span>[<?php echo $cot; ?>]</a></li>
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
        <h3 class="text-center">Cart</h3>
      <br>
			<div class="container m-t-30">
          <div class="row">





  <div class="col-xs-12 col-sm-8 ">
                        <div class="menu-widget" id="2">
                          <?php

                    if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?=$_SESSION['msg_type']?>">

                      <?php
                          echo $_SESSION['message'];
                          unset($_SESSION['message']);
                      ?>

                  </div>
                <?php endif ?>
</div>

<br>

          <table class="table" id="userTbl">
<thead class="text-center">
<tr>
<th scope="col" style="text-align:center">Image</th>
<th scope="col" style="text-align:center">Name</th>
<th scope="col" style="text-align:center">Description</th>
<th scope="col" style="text-align:center">Price</th>
<th scope="col" style="text-align:center">Quantity</th>
<th scope="col" style="text-align:center">Total</th>

<th scope="col">Action</th>


</tr>
</thead>
<tbody class="text-center">
<?php
     $total = 0;
       if (isset($_SESSION['shop_Cart'])&&isset($_SESSION['custID']))
       {

         $c = 0;
         foreach ($_SESSION['shop_Cart'] as $key => $value)
         {
                $i = $value['i'];

                $sql = "SELECT* FROM product WHERE prodID = '$i';";
                $result = mysqli_query($conn,$sql);
                $check = mysqli_num_rows($result);

                if ($check == "1")
                {
                        $row = mysqli_fetch_assoc($result);
                        $img = $row['prodImg'];
                        $img = "../admin/img/".$img;
                        $price =  $row['productPrice'];



                }

                $itemT = $price *   $value['quantity'];
               $total = $total + $itemT;
               $c++;
               $r = $_GET['id'];
               //$itemP =  $value['itemprice']/$value['quantity'];
               echo "
               <tr>

               <td>
               <img style='height: 20%;width: 20%;' class='card-img-top rounded mx-auto d-block' src= $img>
               </td>
               <td>$value[itemname]</td>


               <td>
                      $value[item_Desr]
               </td>
               <td>
                      R$price
               </td>
               <td>
                    $value[quantity]

               </td>
               <td>

                        R$itemT
               </td>
                 <td>
                 <form  action='manage_cart.php?type=display&id=$r&page=$page' method='POST'>
                   <button type='submit'  class='btn btn-danger' name='remove'>Remove</button>
                   <input type='hidden' name='item' value='$value[itemname]'>
                 </form>

               </td>
               </tr>";
         }


       }
       else
       {
                          echo "<td colspan='9'>No product found</td>";
       }


?>

</tbody>

</table>
 <br>
<form class="" action="manage_cart.php?type=display&id=<?php echo $_GET['id']."&page=".$page; ?>" method="POST">
     <?php
     $v = $_GET['id'];
     if ($cot>0)
     {
          echo "<a  href='manage_cart.php?type=display&id=$v&page=$page'><button class='btn btn-danger text-center' type='submit' name='clear'>Clear Cart</button></a>";
     }


     ?>



   </form>



</div>

                  </div>
                  <div class="col-md-12">

                                    <div class="widget widget-cart text-xs-center">
                                           <div class="widget-heading">
                                               <h3 class="widget-title text-dark">
                                            Your Shopping Cart
                                   </h3>

                                   <?php

                                      if (isset($_SESSION['message'])): ?>
                                      <div class="alert alert-<?=$_SESSION['msg_type']?>">

                                        <?php
                                            echo $_SESSION['message'];
                                            unset($_SESSION['message']);
                                        ?>
                                    </div>
                                   <?php endif ?>
                                               <div class="clearfix"></div>
                                           </div>

                                           <div class="widget-body">
                                               <div class="price-wrap text-xs-center">



                                                   <?php
                                                       if ($cot>0)
                                                       {
                                                         echo "<p>TOTAL DUE: R$total</p>";
                                                         $a = $_GET['id'];
                                                         echo "<p>---Choose Payment Method---</p>";
                                                         echo "<h3 class='value'><strong></strong></h3>";
                                                         echo "

                                                         <form  action='methodType.php' method='POST'>
                                                               <input type='radio' name='metho' value='cash'>
                                                               <label for='Cash'>Cash</label><br>
                                                               <input type='radio' name='metho' value='card'>
                                                               <label for='Card'>Card</label><br>
                                                               <p>---Choose Delivery Method---</p>
                                                               <input type='radio' name='deliveryMethod' value='pickup' required>
                                                               <label for='Cash'>Pick-Up</label><br>
                                                               <input type='radio' name='deliveryMethod' value='delivery' required>
                                                               <label for='Card'>Delivery</label><br>
                                                               <input hidden type='text' name='id' value='$a'>
                                                               <input hidden type='text' name='cartAmt' value='$total'>
                                                               <button class='btn btn-primary' type='submit' name='checkout'>Checkout</button>
                                                         </form>
                                                         ";
                                                       }
                                                       else
                                                       {
                                                               echo "<p>Empty Cart</p>";
                                                       }

                                                   ?>

                                               </div>
                                           </div>




                                       </div>
                               </div>
                               <br>
			</div>

 <br>







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
