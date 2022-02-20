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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <style media="screen">
    body{margin-top:20px;}

.comment-wrapper .panel-body {
  max-height:650px;
  overflow:auto;
}

.comment-wrapper .media-list .media img {
  width:64px;
  height:64px;
  border:2px solid #e5e7e8;
}

.comment-wrapper .media-list .media {
  border-bottom:1px dashed #efefef;
  margin-bottom:25px;
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
            <li ><a href="add_product.php"><span class="icon-cutlery mr-3"></span>Add Products</a></li>
            <li ><a href="viewProducts.php"><span class="icon-eye mr-3 "></span>View Products</a></li>

            <li class="nav-item "><a href="orders.php"><span class="icon-eye mr-3"></span>Customer Orders</a></li>
            <li class="nav-item active"><a href="comments.php"><span class="icon-eye mr-3"></span>Comments</a></li>
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




            <div class="col-md-8 col-sm-12">
                <div class="comment-wrapper">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                          <p class="text-center">Comment panel</p>
                        </div>
                        <br>
                        <div class="panel-body">

                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <span class="text-muted pull-right">
                                            <small class="text-muted">30 min ago</small>
                                        </span>
                                        <strong class="text-success">@MartinoMont</strong>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Lorem ipsum dolor sit amet, <a href="#">#consecteturadipiscing </a>.
                                        </p>
                                    </div>
                                </li>
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="https://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <span class="text-muted pull-right">
                                            <small class="text-muted">30 min ago</small>
                                        </span>
                                        <strong class="text-success">@LaurenceCorreil</strong>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Lorem ipsum dolor <a href="#">#ipsumdolor </a>adipiscing elit.
                                        </p>
                                    </div>
                                </li>
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="https://bootdey.com/img/Content/user_3.jpg" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <span class="text-muted pull-right">
                                            <small class="text-muted">30 min ago</small>
                                        </span>
                                        <strong class="text-success">@JohnNida</strong>
                                        <p>
                                            Lorem ipsum dolor <a href="#">#sitamet</a> sit amet, consectetur adipiscing elit.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <br>


                        </div>
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

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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
