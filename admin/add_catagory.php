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



$sql ="SELECT * FROM admin WHERE adminID='$adminID'; ";

$results = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($results);

  $adminName=$row['adminName'];
  $adminEmail=$row['adminEmail'];
  $storeid=$row['storeID'];


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
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
          <?php
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
          <h3 class="name">Admin Name: <?php echo $row['adminName']; ?></h3>
          <span class="country">Store Name: <?php echo $row['storeName']; ?></span>
        </div>


        <div class="nav-menu">
          <ul>
            <li ><a href="index.php"><span class="icon-tachometer mr-3"></span>Dashboard</a></li>

            <li ><a href="add_product.php"><span class="icon-cutlery mr-3"></span>Add Products</a></li>
            <li><a href="viewProducts.php"><span class="icon-eye mr-3 "></span>View Products</a></li>
            <li class="nav-item active"><a href="add_catagory.php"><span class="icon-eye mr-3 "></span>Add Catagory</a></li>
          <!--  <li><a href="add_Customers.php"><span class="icon-user-plus mr-3"></span>Add Customers</a></li>
            <li><a href="viewProducts.php"><span class="icon-eye mr-3"></span>View Customers</a></li>-->
            <li ><a href="orders.php"><span class="icon-eye mr-3"></span>Customer Orders</a></li>

            <li ><a href="profile.php"><span class="icon-user mr-3"></span>Profile</a></li>
            <li><a href="logout.php"><span class="icon-sign-out mr-3"></span>Sign out</a></li>

          </ul>
        </div>
      </div>

    </aside>
    <main>
      <div class="site-section">

        <div class="container">
          <div class="row justify-content-center">

                <div class="col-md-4 mx-auto">
                <div id="first">
                  <div class="myform form ">
                      <br>
                     <div class="logo mb-3">
                       <div class="col-md-12 text-center">
                        <h4>Catagory</h4>
                       </div>
                    </div>

                    <form action="add_catagory.php" method="post" novalidate="novalidate" enctype="multipart/form-data">

                            <div class="form-group">
                               <label for="exampleInputEmail1">Catagory Name</label>
                               <input type="text" name="catName"   class="form-control" style="border-radius: 50px;"  placeholder="Enter Catagory Name" >
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

                                <button class="btn btn-success" name="btnCatag" type="submit" id="sendMessageButton">Add Catagory</button>
                            </div>


                       </form>
                                <br>
                                <br>
                                <br>
                                <br>
                  </div>
                </div>
                </div>
          </div>
        </div>

      </div>

    </main>

    <script src="qrCodeScanner.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
  <?php

if (isset($_POST['btnCatag']))
{
      $cat_name = ucwords($_POST['catName']);


      if (empty($cat_name))
      {

        $_SESSION['message'] = "Fill in Catagory Field";
        $_SESSION['msg_type'] = "danger";
        echo "<script>location.replace('add_catagory.php');</script>";
        exit();

      }
      else
       {
         if (!empty($cat_name))
         {
               if (preg_match("/^[a-zA-Z\s]+$/",$cat_name))
               {

                    $sql = "INSERT INTO catagory(catagoryName)VALUES('$cat_name')";
                    mysqli_query($conn,$sql);

                    $_SESSION['message'] = "Catagory Successfuly Added";
                    $_SESSION['msg_type'] = "success";
                    echo "<script>location.replace('add_catagory.php');</script>";
                    exit();


              }
              else
               {
                  $_SESSION['message'] = "Catagory field must be characters";
                  $_SESSION['msg_type'] = "danger";
                  echo "<script>location.replace('add_catagory.php');</script>";
                  exit();
              }

        }
        else
         {
           $_SESSION['message'] = "Catagory Name is empty";
            $_SESSION['msg_type'] = "danger";
            echo "<script>location.replace('add_catagory.php');</script>";
            exit();
        }

 }

}






  ?>
</html>
