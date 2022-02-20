<?php

include_once "../admin/database/dbConn.php";
session_start();
if (!isset($_SESSION['custID'])&&!isset($_SESSION['custEmail'])) {
  $_SESSION['message'] = "Please Login folks!!!";
   $_SESSION['msg_type'] = "danger";
  echo "<script>location.replace('../login.php');</script>";
  exit();
}


if (isset($_POST['checkout']))
{

      $id = $_POST['id'];
      $total = $_POST['cartAmt'];

      if (isset($_POST['metho']))
      {

        $type = $_POST['metho'];

        if ($type == "card")
        {
          $ulr = 'payment.php?type=payment&id='.$id.'&cartAmt='.$total."&page=product";
          echo "<script>location.replace('$ulr');</script>";
          exit();
        }
        elseif($type == "cash")
        {
          $ulr = 'paymentCash.php?type=payment&id='.$id.'&cartAmt='.$total."&page=product";
          echo "<script>location.replace('$ulr');</script>";
          exit();
        }


      }
      else
      {

        $ulr = 'cart.php?type=payment&id='.$id.'&cartAmt='.$total."&page=product";
        echo "<script>location.replace('$ulr');</script>";
        exit();


      }
}

?>
