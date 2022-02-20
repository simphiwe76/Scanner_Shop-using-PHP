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


if (isset($_POST['btnCustomer'])&&isset($_SESSION['adminEmail']))
{


        $nameC = mysqli_real_escape_string($conn,ucwords($_POST['nameC']));
        $custSirname = mysqli_real_escape_string($conn,ucwords($_POST['custSirname']));
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);


    if (empty($nameC)&&empty($custSirname)&&empty($gender)&&empty($email))
    {

      $_SESSION['message'] = "All field are empty";
      $_SESSION['msg_type'] = "danger";
      echo "<script>location.replace('add_Customers.php');</script>";
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



                                                                  $sql = "SELECT* FROM customer WHERE customerEmail = '$email';";
                                                                  $result = mysqli_query($conn,$sql);
                                                                  $numR = mysqli_num_rows($result);


                                                                  if ($numR>0)
                                                                  {
                                                                    $_SESSION['message'] = "Already have Account with us";
                                                                     $_SESSION['msg_type'] = "danger";
                                                                     echo "<script>location.replace('add_Customers.php');</script>";
                                                                     exit();
                                                                  }
                                                                  else
                                                                  {
                                                                    $cPwd = strtoupper(substr(uniqid(true,''),-5));
                                                                    $pwdN = password_hash($cPwd, PASSWORD_DEFAULT);
                                                                    $sql = "INSERT INTO customer (customerName,customerSurname,customerGender,customerEmail,customerPwd)
                                                                            Values('$nameC','$custSirname','$gender','$email','$pwdN')";
                                                                    mysqli_query($conn,$sql);

                                                                    $date = date('d-m-Y');
                                                                    $uComm = "You have Successfully created an Account "."\r\r"."Date : ".$date."\r\r"."\r\r"." Username : ".$email."\r\r"."\r\r"."Your Login datails are below "."\r\r"."\r\r"." Username : ".$email."\r\r"." Password : ".$cPwd."\r\r"."\r\r"." Thank you enjoy your Shopping app";
                                                                    $fromEmail = 'simphiwemthanti76@gmail.com';
                                                                    $toEmail =  $email;
                                                                    $subjectName = $bankN.' Auto reply';
                                                                    $message = $uComm;


                                                                    $to = $toEmail;
                                                                    $subject = $subjectName;
                                                                    $headers = "MIME-Version: 1.0" . "\r\n";
                                                                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                                                    $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();
                                                                    $message = '<!doctype html>
                                                                    <html lang="en">
                                                                    <head>
                                                                    <meta charset="UTF-8">
                                                                    <meta name="viewport"
                                                                    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                                                                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                                                    <title>Document</title>
                                                                    </head>
                                                                    <body>
                                                                    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
                                                                    <div class="container">
                                                                   '.$message.'<br/>
                                                                   Regards<br/>
                                                                   '.$fromEmail.'
                                                                   </div>
                                                                   </body>
                                                                   </html>';
                                                                   $result = @mail($to, $subject, $message, $headers);


                                                                    $_SESSION['message'] = "Successfully Registered";
                                                                     $_SESSION['msg_type'] = "success";
                                                                     echo "<script>location.replace('viewProducts.php');</script>";
                                                                     exit();

                                                                  }



                                              }
                                              else
                                              {
                                                $_SESSION['message'] = "Email is not valid";
                                                 $_SESSION['msg_type'] = "danger";
                                                 echo "<script>location.replace('add_Customers.php');</script>";
                                                 exit();
                                              }
                                          }
                                          else
                                          {
                                            $_SESSION['message'] = "Email field is empty";
                                             $_SESSION['msg_type'] = "danger";
                                             echo "<script>location.replace('add_Customers.php');</script>";
                                             exit();
                                          }
                                      }
                                      else
                                      {
                                        $_SESSION['message'] = "Select gender";
                                         $_SESSION['msg_type'] = "danger";
                                         echo "<script>location.replace('add_Customers.php');</script>";
                                         exit();
                                      }
                                }
                                else
                                {
                                  $_SESSION['message'] = "Surname field must be characters";
                                   $_SESSION['msg_type'] = "danger";
                                   echo "<script>location.replace('add_Customers.php');</script>";
                                   exit();
                                }
                          }
                          else
                          {
                            $_SESSION['message'] = "Surname field must is empty";
                             $_SESSION['msg_type'] = "danger";
                             echo "<script>location.replace('add_Customers.php');</script>";
                             exit();
                          }
                  }
                  else
                  {
                    $_SESSION['message'] = "Name field must be characters";
                     $_SESSION['msg_type'] = "danger";
                     echo "<script>location.replace('add_Customers.php');</script>";
                     exit();
                  }
            }
            else
            {
              $_SESSION['message'] = "Name field are empty";
               $_SESSION['msg_type'] = "danger";
               echo "<script>location.replace('add_Customers.php');</script>";
               exit();
            }
    }



}

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

                <div class="col-md-4 mx-auto">
                <div id="first">
                  <div class="myform form ">
                      <br>
                     <div class="logo mb-3">
                       <div class="col-md-12 text-center">
                        <h4>Add Customer</h4>
                       </div>
                    </div>

                             <form action="add_Customers.php" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Customer Name</label>
                                        <input type="email" name="nameC"  class="form-control"  style="border-radius: 50px;"  placeholder="Enter Name">
                                     </div>

                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Customer Surname</label>
                                        <input type="text" name="custSirname"   class="form-control" style="border-radius: 50px;"  placeholder="Enter Surname">
                                     </div>
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Customer Gender</label>
                                          <select class="form-control" style="border-radius: 50px;" name="gender">
                                                <option value="">--- Select Gender ---</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                          </select>

                                     </div>
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Customer Email</label>
                                        <input type="email" name="email"   class="form-control" style="border-radius: 50px;"  placeholder="Enter Email">
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

                                         <button class="btn btn-success" name="btnCustomer" type="submit" id="sendMessageButton">Add Customer</button>
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
</html>
