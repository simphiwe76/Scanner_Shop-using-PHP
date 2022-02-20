<?php
include_once "database/dbConn.php";
session_start();

if (!isset($_SESSION['adminID'])&&!isset($_SESSION['adminEmail'])&&!isset($_SESSION['adminStoreID']))
{
  echo "<script>location.replace('../index.html');</script>";
  exit();

}


 $adminID = $_SESSION['adminID'];
 $adminEmail = $_SESSION['adminEmail'];
 $adminStoreID = $_SESSION['adminStoreID'];


 if (isset($_SESSION['adminEmail']))
 {
      $sql = "SELECT S.storeName,A.adminName FROM admin A,store S
             WHERE S.storeID = A.storeID AND A.storeID = '$adminStoreID';";
      $result = mysqli_query($conn,$sql);
      $numR = mysqli_num_rows($result);

      if ($numR == 1)
      {
          $row = mysqli_fetch_assoc($result);
      }
 }
?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Admin</title>
  </head>
  <body>


    <aside class="sidebar">
      <div class="toggle">
        <a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
              <span></span>
            </a>
      </div>
      <div class="side-inner">

        <div class="profile">

          <h3 class="name">Admin Name: <?php echo $row['adminName']; ?></h3>
          <span class="country">Store Name: <?php echo $row['storeName']; ?></span>
        </div>


        <div class="nav-menu">
          <ul>
            <li class="nav-item active"><a href="index.php"><span class="icon-tachometer mr-3"></span>Dashboard</a></li>

            <li><a href="add_product.php"><span class="icon-cutlery mr-3"></span>Add Products</a></li>
            <li><a href="viewProducts.php"><span class="icon-eye mr-3 "></span>View Products</a></li>
            <li><a href="add_catagory.php"><span class="icon-eye mr-3 "></span>Add Catagory</a></li>
          <!--  <li><a href="add_Customers.php"><span class="icon-user-plus mr-3"></span>Add Customers</a></li>
            <li><a href="viewProducts.php"><span class="icon-eye mr-3"></span>View Customers</a></li>-->
            <li class="nav-item "><a href="orders.php"><span class="icon-eye mr-3"></span>Customer Orders</a></li>

            <li><a href="profile.php"><span class="icon-user mr-3"></span>Profile</a></li>
            <li><a href="logout.php"><span class="icon-sign-out mr-3"></span>Sign out</a></li>

          </ul>
        </div>
      </div>

    </aside>
    <main>

          <div class="site-section">
            <div class="container">
              <div class="row justify-content-center">
                    <img class="" src="../images/img/bann8.jpg" alt="">
              </div>
            </div>
          </div>
    </main>



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
