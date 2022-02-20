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
          <span class="country">Store Name: <?php echo $row['storeName']; ?></span>>
        </div>


        <div class="nav-menu">
          <ul>
            <li ><a href="index.php"><span class="icon-tachometer mr-3"></span>Dashboard</a></li>

            <li ><a href="add_product.php"><span class="icon-cutlery mr-3"></span>Add Products</a></li>
            <li><a href="viewProducts.php"><span class="icon-eye mr-3 "></span>View Products</a></li>
              <li><a href="add_catagory.php"><span class="icon-eye mr-3 "></span>Add Catagory</a></li>
          <!--  <li><a href="add_Customers.php"><span class="icon-user-plus mr-3"></span>Add Customers</a></li>
            <li><a href="viewProducts.php"><span class="icon-eye mr-3"></span>View Customers</a></li>-->
            <li ><a href="orders.php"><span class="icon-eye mr-3"></span>Customer Orders</a></li>

            <li class="nav-item active"><a href="profile.php"><span class="icon-user mr-3"></span>Profile</a></li>
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
                        <h4>Update Profile</h4>
                       </div>
                    </div>

                    <form action="profile.php" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            <div class="form-group">
                               <label for="exampleInputEmail1">Admin Name</label>
                               <input type="text" name="name"  class="form-control"  style="border-radius: 50px;" value="<?php echo "$adminName"?>" required>


                            </div>

                            <div class="form-group">
                               <label for="exampleInputEmail1">Admin Surname</label>
                               <input  type="email" name="email"   class="form-control" style="border-radius: 50px;" value="<?php echo "$adminEmail"?>" required>
                            </div>


                               <input  type="hidden" name="storeid"   class="form-control" style="border-radius: 50px;"  value="<?php echo "$storeid"?>" required>

                            <div class="form-group">
                               <label for="exampleInputEmail1">Password</label>
                               <input type="text" name="password"   class="form-control" style="border-radius: 50px;"  placeholder="Enter Password" required>
                            </div>
                            <div class="form-group">
                               <label for="exampleInputEmail1">Confirm Password</label>
                               <input type="text" name="cpassword"   class="form-control" style="border-radius: 50px;"  placeholder="Enter Confirm Password" required>
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

                                <button class="btn btn-success" name="btnProfile" type="submit" id="sendMessageButton">Update Profile</button>
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

if (isset($_POST['btnProfile']))
{
      $ad_name = ucwords($_POST['name']);
      $ad_email = ucwords($_POST['email']);
      $pwd = $_POST['password'];
      $cPwd = $_POST['cpassword'];

      if (empty($ad_name)&&empty($ad_email)&&empty($pwd)&&empty($cPwd))
      {

        $_SESSION['message'] = "All field are empty";
        $_SESSION['msg_type'] = "danger";
        echo "<script>location.replace('profile.php');</script>";
        exit();

      }
      else
       {
         if (!empty($ad_name))
         {
               if (preg_match("/^[a-zA-Z\s]+$/",$ad_name))
               {
                           if (!empty($ad_email))
                           {
                                     if (filter_var($ad_email, FILTER_VALIDATE_EMAIL))
                                     {
                                                   if (!empty($pwd))
                                                   {
                                                                 if (!empty($cpwd))
                                                                 {


                                                                        if(  $pwd==$cPwd )
                                                                        {
                                                                          //  $pwdN = password_hash($cPwd, PASSWORD_DEFAULT);
                                                                        $sql="UPDATE admin SET
                                                                        adminName ='$ad_name',adminEmail ='$ad_email'
                                                                        ,adminPwd='$pwd' WHERE adminID ='$adminID';";
                                                                        $run_query= mysqli_query($conn,$sql);
                                                                         echo "<script>alert('Profile Updated;) ');</script>";
                                                                        echo "<script>location.replace('index.php');</script>";
                                                                            exit();
                                                                        }
                                                                        else {
                                                                          $_SESSION['message'] = "Password doesnot match";
                                                                           $_SESSION['msg_type'] = "danger";
                                                                           echo "<script>location.replace('profile.php');</script>";
                                                                           exit();
                                                                        }
                                                                    }
                                                                    else {
                                                                      $_SESSION['message'] = "Confirm Password is Empty";
                                                                        $_SESSION['msg_type'] = "danger";
                                                                        echo "<script>location.replace('profile.php');</script>";
                                                                        exit();
                                                                    }

                                                      }
                                                      else
                                                      {
                                                       $_SESSION['message'] = "Password is Empty";
                                                         $_SESSION['msg_type'] = "danger";
                                                         echo "<script>location.replace('profile.php');</script>";
                                                         exit();
                                                     }

                                        }
                                        else
                                         {
                                          $_SESSION['message'] = "Email is invalid";
                                            $_SESSION['msg_type'] = "danger";
                                            echo "<script>location.replace('profile.php');</script>";
                                            exit();
                                        }

                          }
                          else
                           {
                            $_SESSION['message'] = "Email is empty";
                              $_SESSION['msg_type'] = "danger";
                              echo "<script>location.replace('profile.php');</script>";
                              exit();
                          }
                  }
                  else
                   {
                    $_SESSION['message'] = "Name field must be characters";
                      $_SESSION['msg_type'] = "danger";
                      echo "<script>location.replace('profile.php');</script>";
                      exit();
                  }

        }
        else
         {
           $_SESSION['message'] = "Name is empty";
            $_SESSION['msg_type'] = "danger";
            echo "<script>location.replace('profile.php');</script>";
            exit();
        }

 }

}






  ?>
</html>
