<?php
include_once "../../admin/database/dbConn.php";
session_start();

 $cusID= $_SESSION['custID'];
 $cusEmail = $_SESSION['custEmail'];

 $storeId = $_GET['id'];

if (isset($_SESSION['custEmail'])&&isset($_GET['type']))
{
      if ($_GET['type'] == "done")
      {
        echo "<script>location.replace('../cart.php?type=shop&id=$storeId&page=scan');</script>";
        exit();
      }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Scan Product</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>



        <div class="container" id="QR-Code">
          <?php

                     if (isset($_SESSION['message'])): ?>
                     <div class="alert alert-<?=$_SESSION['msg_type']?>">

                       <?php
                           echo $_SESSION['message'];
                           unset($_SESSION['message']);
                       ?>
                   </div>
                 <?php endif ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="navbar-form navbar-left">
                        <h4 class="text-center">Scan To Add Product</h4>
                        <br>
                        <a href="../index.php"><button  class="btn btn-info btn-sm "  name=""  type="submit" >Home</button></a>
                         <a href="scanProduct.php?type=done&id=<?php echo $storeId; ?>"><button  class="btn btn-info btn-sm "  name=""  type="submit" >Done Scanning Products</button></a>


                    </div>
                    <div class="navbar-form navbar-right">
                        <select class="form-control" id="camera-select"></select>
                        <div class="form-group">
                            <input hidden id="image-url" type="text" class="form-control" placeholder="Image url">
                            <button hidden  title="Decode Image"  class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-upload"></span></button>
                            <button hidden  title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-picture"></span></button>
                            <button hidden title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"></span></button>
                            <button hidden title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-pause"></span></button>
                            <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>
                         </div>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <div class="col-md-6">
                        <div class="well" style="position: relative;display: inline-block;">
                            <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
                            <div  class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>

                        </div>
                        <div class="caption">
                            <h3>Scanned result</h3>
                            <p id="scanned-QR"></p>
                            <form   action="../Product.php?type=shop&id=<?php echo  $storeId ?>" method="post">
                       <input hidden type="text" id="e" name="prodNumber" value="">
                      <b><button type="submit" class="btn btn-primary" name="btnFind">Find Product</button></b>
                  </form>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="thumbnail" id="result">
                            <div class="well" style="overflow: hidden;">
                                <img width="320" height="240" id="scanned-img" src="">
                            </div>

                        </div>
                    </div>
                </div>

        </div>
        </div>



        <script type="text/javascript" src="js/filereader.js"></script>
        <!-- Using jquery version: -->
        <!--
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/qrcodelib.js"></script>
            <script type="text/javascript" src="js/webcodecamjquery.js"></script>
            <script type="text/javascript" src="js/mainjquery.js"></script>
        -->
        <script type="text/javascript" src="js/qrcodelib.js"></script>
        <script type="text/javascript" src="js/webcodecamjs.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>
