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




if (isset($_POST['btnProdUp'])&&isset($_SESSION['adminID'])&&isset($_GET['id']))
{

        $productName = $_POST['nameP'];
        $productPrice = $_POST['price'];
        $productImage = $_FILES['image'];
        $productQuantity = $_POST['quantity'];
        $id = $_GET['id'];

        $fileTmpPath = $productImage['tmp_name'];
        $fileName = $productImage['name'];
        $fileSize = $productImage['size'];
        $fileType = $productImage['type'];
        $error = $productImage['error'];

  if (empty($productName)&&empty($productPrice)&&empty($fileName)&&empty($productQuantity))
  {

    $_SESSION['message'] = "All field are empty";
    $_SESSION['msg_type'] = "danger";
    echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
    exit();

  }


          if (!empty($productName))
          {
                  if (preg_match("/^[a-zA-Z\s]+$/",$productName))
                  {
                            if (!empty($productPrice))
                            {
                                      if (preg_match("/^[0-9.\d]+$/",$productPrice))
                                      {
                                                if (!empty($productQuantity))
                                                {
                                                        if (preg_match("/^[0-9\d]+$/",$productQuantity))
                                                        {
                                                                  if (!empty($fileName))
                                                                  {

                                                                                    $fileExt = explode('.',$fileName);
                                                                                    $fileActualExt = strtolower(end($fileExt));
                                                                                    $allowed = array('jpg','png','jpeg','gif');


                                                                                    if (in_array($fileActualExt, $allowed))
                                                                                    {




                                                                                                    $fileNameN = uniqid('',true).".".$fileActualExt;
                                                                                                    $dest = "img/".$fileNameN;
                                                                                                    move_uploaded_file($fileTmpPath,$dest);


                                                                                                    $sql = "UPDATE product SET productName = '$productName',productPrice='$productPrice'
                                                                                                            ,prodQuantity = '$productQuantity',prodImg = '$fileNameN' WHERE prodID = '$id';";
                                                                                                    mysqli_query($conn,$sql);
                                                                                                    $_SESSION['message'] = "Product successfuly updated";
                                                                                                    $_SESSION['msg_type'] = "success";
                                                                                                    echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
                                                                                                    exit();





                                                                                  }
                                                                                    else
                                                                                   {
                                                                                        $_SESSION['message'] = "Only jpg,png,jpeg and gif are allowed";
                                                                                        $_SESSION['msg_type'] = "danger";
                                                                                        echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
                                                                                        exit();
                                                                                  }






                                                                  }
                                                                  else
                                                                  {

                                                                    $sql = "UPDATE product SET productName = '$productName',productPrice='$productPrice'
                                                                            ,prodQuantity = '$productQuantity' WHERE prodID = '$id';";
                                                                    mysqli_query($conn,$sql);


                                                                    $_SESSION['message'] = "Product successfuly updated";
                                                                    $_SESSION['msg_type'] = "success";
                                                                    echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
                                                                    exit();
                                                                  }
                                                        }
                                                        else
                                                        {
                                                          $_SESSION['n'] = $productName;
                                                          $_SESSION['p'] = $productPrice;
                                                          $_SESSION['q'] = $productQuantity;
                                                          $_SESSION['message'] = "Product quantity must be digit";
                                                          $_SESSION['msg_type'] = "danger";
                                                          echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
                                                          exit();
                                                        }
                                                }
                                                else
                                                {
                                                  $_SESSION['n'] = $productName;
                                                  $_SESSION['p'] = $productPrice;
                                                  $_SESSION['q'] = $productQuantity;
                                                  $_SESSION['message'] = "Product Quantity is empty";
                                                  $_SESSION['msg_type'] = "danger";
                                                  echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
                                                  exit();
                                                }
                                      }
                                      else
                                      {
                                        $_SESSION['n'] = $productName;
                                        $_SESSION['p'] = $productPrice;
                                        $_SESSION['q'] = $productQuantity;
                                        $_SESSION['message'] = "Product price must be digit";
                                        $_SESSION['msg_type'] = "danger";
                                        echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
                                        exit();
                                      }
                            }
                            else
                            {
                              $_SESSION['n'] = $productName;
                              $_SESSION['p'] = $productPrice;
                              $_SESSION['q'] = $productQuantity;
                              $_SESSION['message'] = "Product price is empty";
                              $_SESSION['msg_type'] = "danger";
                              echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
                              exit();
                            }
                  }
                  else
                  {
                    $_SESSION['n'] = $productName;
                    $_SESSION['p'] = $productPrice;
                    $_SESSION['q'] = $productQuantity;
                    $_SESSION['message'] = "Product name must be characters";
                    $_SESSION['msg_type'] = "danger";
                    echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
                    exit();
                  }
          }
          else
          {
            $_SESSION['n'] = $productName;
            $_SESSION['p'] = $productPrice;
            $_SESSION['q'] = $productQuantity;
            $_SESSION['message'] = "Product name is empty";
            $_SESSION['msg_type'] = "danger";
            echo "<script>location.replace('prodEdit.php?type=update&id=$id');</script>";
            exit();
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
            <li class="nav-item active"><a href="viewProducts.php"><span class="icon-eye mr-3 "></span>View Products</a></li>
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
        <?php

        if (isset($_SESSION['adminEmail'])&&isset($_GET['type'])&&isset($_GET['id']))
        {
                    $id = $_GET['id'];
                    $type = $_GET['type'];

                    if ($type == 'update')
                    {
                          $sql = "SELECT* FROM product WHERE prodID = '$id' AND storeID = '$adminStoreID';";
                          $result =  mysqli_query($conn,$sql);

                          if (mysqli_num_rows($result) == 1)
                          {
                                $row = mysqli_fetch_assoc($result);
                          }


                    }


        }



        ?>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-12 text-center">
              <img src="img/<?php echo $row['prodImg']; ?>"  style="width: 200px;height: 200px;border-radius: 8px;" id="output"/>
            </div>



                <div class="col-md-4 mx-auto">
                <div id="first">
                  <div class="myform form ">
                      <br>
                     <div class="logo mb-3">
                       <div class="col-md-12 text-center">
                        <h4>Update Product</h4>
                       </div>
                    </div>

                             <form action="prodEdit.php?type=update&id=<?php echo $id; ?>" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Product Name</label>
                                        <input type="email" name="nameP"  class="form-control"  style="border-radius: 50px;"  placeholder="Enter product name"
                                        value="<?php

                                          if (!empty($_SESSION['n']))
                                          {
                                              echo $_SESSION['n'];
                                              unset($_SESSION['n']);
                                          }
                                          else
                                          {
                                                echo $row['productName'];
                                          }


                                    ?>"

                                        >
                                     </div>
                                     <input hidden id="e" type="text" name="prodNo" >
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Product Price</label>
                                        <input type="text" name="price"   class="form-control" style="border-radius: 50px;"  placeholder="Enter price"
                                                  value="<?php

                                                    if (!empty($_SESSION['p']))
                                                    {
                                                        echo $_SESSION['p'];
                                                        unset($_SESSION['p']);
                                                    }
                                                    else
                                                    {
                                                          echo $row['productPrice'];
                                                    }


                                              ?>"
                                        >
                                     </div>
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Product Quantity</label>
                                        <input type="number" name="quantity" min="1"  class="form-control" style="border-radius: 50px;"  placeholder="Enter Quantity"
                                        value="<?php

                                          if (!empty($_SESSION['q']))
                                          {
                                              echo $_SESSION['q'];
                                              unset($_SESSION['q']);
                                          }
                                          else
                                          {
                                                echo $row['prodQuantity'];
                                          }


                                    ?>"
                                        >
                                     </div>

                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Product Image</label>
                                        <input type="file" name="image" onchange="loadFile(event)"  class="form-control" style="border-radius: 50px;"  placeholder="Enter Quantity">
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

                                         <button class="btn btn-success" name="btnProdUp" type="submit" id="sendMessageButton">Update Product</button>
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

                 <script>
                 var loadFile = function(event) {
                 var reader = new FileReader();
                 reader.onload = function(){
                   var output = document.getElementById('output');
                   output.src = reader.result;
                 };
                 reader.readAsDataURL(event.target.files[0]);
                 };
                 </script>

    <script src="qrCodeScanner.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
