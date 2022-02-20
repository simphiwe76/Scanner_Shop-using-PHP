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



$page = $_GET['page'];
$budgetAmt = $_SESSION['budgetAmt'];

  $j = $_GET['id'];
  if (isset($_POST['add_cart'])&&isset($_SESSION['custID']))
  {
        $qId  = $_POST['i'];

        $dirPage = $_POST['dirPage'];


        $sql = "SELECT* FROM product WHERE prodID = '$qId'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);


        if ($row['prodQuantity']>=$_POST['quantity'])
        {
          if (isset($_SESSION['shop_Cart']))
          {



                $myitems = array_column($_SESSION['shop_Cart'],'itemname');

                if (in_array($_POST['item_Name'],  $myitems))
                {

                       $_SESSION['message'] = "Product Already on Cart";
                       $_SESSION['msg_type'] = "danger";

                       if ($dirPage == "productList.php")
                       {
                          $ulr = 'productList.php?type=shop&id='.$j;
                       }
                       elseif($dirPage == "scanProduct.php")
                       {
                              $ulr = 'scanner/scanProduct.php?type=shop&id='.$j;
                       }


                      echo "<script>location.replace('$ulr');</script>";
                      exit();
                }
                else
                {
                    $count = count($_SESSION['shop_Cart']);

                  $totalAmt = $_POST['item_Price'] * $_POST['quantity'];

                  foreach ($_SESSION['shop_Cart'] as $key => $value)
                  {

                        $totalAmt = $totalAmt +  ($value['price'] * $value['quantity']);

                  }


                  if ($totalAmt>$budgetAmt)
                  {
                    $_SESSION['message'] = "You are greater then budget amount";
                    $_SESSION['msg_type'] = "danger";

                   if ($dirPage == "productList.php")
                   {
                      $ulr = 'productList.php?type=shop&id='.$j;
                   }
                   elseif($dirPage == "scanProduct.php")
                   {
                          $ulr = 'scanner/scanProduct.php?type=shop&id='.$j;
                   }

                   echo "<script>location.replace('$ulr');</script>";
                   exit();
                  }


                    $_SESSION['shop_Cart'][$count] = array('itemname'=>$_POST['item_Name'],
                                                            'i'=>$_POST['i'],
                                                           'quantity'=>$_POST['quantity'],
                                                           'price'=>$_POST['item_Price'],
                                                           'image'=>$_POST['item_image'],
                                                           'item_Desr'=>$_POST['item_Decsription']);


                      $V = $_POST['quantity'];
                      $sql = "UPDATE product SET prodQuantity = prodQuantity - '$V'

                            WHERE prodID = '$qId';";
                            mysqli_query($conn,$sql);

                                                      $_SESSION['message'] = "Product Added to cart";
                                                      $_SESSION['msg_type'] = "success";


                                                      if ($dirPage == "productList.php")
                                                      {
                                                         $ulr = 'productList.php?type=shop&id='.$j;
                                                      }
                                                      elseif($dirPage == "scanProduct.php")
                                                      {
                                                             $ulr = 'scanner/scanProduct.php?type=shop&id='.$j;
                                                      }
                                                      echo "<script>location.replace('$ulr');</script>";
                                                      exit();



                }





          }
          else
          {




            $totalAmt = $_POST['item_Price'] * $_POST['quantity'];

            foreach ($_SESSION['shop_Cart'] as $key => $value)
            {
                  $totalAmt = $totalAmt +  ($value['price'] * $value['quantity']);

            }

            if ($totalAmt>$budgetAmt)
            {
              $_SESSION['message'] = "You are greater then budget amount of R".$budgetAmt;
              $_SESSION['msg_type'] = "danger";

              if ($dirPage == "productList.php")
              {
                 $ulr = 'productList.php?type=shop&id='.$j;
              }
              elseif($dirPage == "scanProduct.php")
              {
                     $ulr = 'scanner/scanProduct.php?type=shop&id='.$j;
              }

              echo "<script>location.replace('$ulr');</script>";
               exit();

            }

            $_SESSION['message'] = "Product Added to cart";
            $_SESSION['msg_type'] = "success";
            $_SESSION['shop_Cart'][0] = array('itemname'=>$_POST['item_Name'],
                                                      'i'=>$_POST['i'],
                                                   'quantity'=>$_POST['quantity'],
                                                   'price'=>$_POST['item_Price'],
                                                   'image'=>$_POST['item_image'],
                                                   'item_Desr'=>$_POST['item_Decsription']);

                                                   $V = $_POST['quantity'];
                                                   $sql = "UPDATE product SET prodQuantity = prodQuantity - '$V'

                                                         WHERE prodID = '$qId';";
                                                   mysqli_query($conn,$sql);



                                              if ($dirPage == "productList.php")
                                              {
                                                 $ulr = 'productList.php?type=shop&id='.$j;
                                              }
                                              elseif($dirPage == "scanProduct.php")
                                              {
                                                     $ulr = 'scanner/scanProduct.php?type=shop&id='.$j;
                                              }
                                              echo "<script>location.replace('$ulr');</script>";
                                              exit();



          }
        }
        else
        {
          $_SESSION['message'] = "Only ".$row['prodQuantity']." items are left for this Quantity";
          $_SESSION['msg_type'] = "danger";


          if ($dirPage == "productList.php")
          {
             $ulr = 'productList.php?type=shop&id='.$j;
          }
          elseif($dirPage == "scanProduct.php")
          {
                 $ulr = 'scanner/scanProduct.php?type=shop&id='.$j;
          }

          echo "<script>location.replace('$ulr');</script>";
          exit();


        }




  }

  if (isset($_POST['remove']))
  {

        foreach ($_SESSION['shop_Cart'] as $key => $value)
        {
              if ($value['itemname'] == $_POST['item'])
              {

                $V = $value['i'];
                $o = $value['quantity'];

                $sql = "UPDATE product SET prodQuantity = prodQuantity + '$o'

                      WHERE prodID = '$V';";
                mysqli_query($conn,$sql);



                  unset($_SESSION['shop_Cart'][$key]);

                  $_SESSION['shop_Cart'] = array_values($_SESSION['shop_Cart']);
                  $_SESSION['message'] = "Product Deleted fror cart ";
                  $_SESSION['msg_type'] = "danger";
                  $url = "cart.php?type=shop&id=".$j."&page=".$page;
                  echo "<script>location.replace('$url');</script>";
                  exit();

              }

        }
  }


  if (isset($_POST['clear']))
  {
    if(isset($_SESSION['shop_Cart']))
    {

              foreach ($_SESSION['shop_Cart'] as $key => $value)
              {

                      $V = $value['i'];
                      $o = $value['quantity'];

                      $sql = "UPDATE product SET prodQuantity = prodQuantity + '$o'

                            WHERE prodID = '$V';";
                      mysqli_query($conn,$sql);

              }

              unset($_SESSION['shop_Cart']);
              $_SESSION['message'] = "Cart Cleared ";
              $_SESSION['msg_type'] = "danger";

              $url = "cart.php?type=shop&id=".$j."&page=".$page;
              echo "<script>location.replace('$url');</script>";
              exit();
    }
    else
    {
      $url = "cart.php?type=shop&id=".$j."&page=".$page;
      echo "<script>location.replace('$url');</script>";
      exit();
    }
  }


?>
