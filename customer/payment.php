<?php

include_once "../admin/database/dbConn.php";
session_start();

if (!isset($_SESSION['custID'])&&!isset($_SESSION['custEmail'])) {
  $_SESSION['message'] = "Please Login folks!!!";
   $_SESSION['msg_type'] = "danger";
  echo "<script>location.replace('../login.php');</script>";
  exit();
}


if (isset($_GET['type'])&&isset($_GET['id'])&&isset($_GET['cartAmt']))
{
        $id = $_GET['id'];
        $cartAmt = $_GET['cartAmt'];
         $page = $_GET['page'];

}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Payment</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="col-md-6 offset-md-3">
                <span class="anchor" id="formPayment"></span>
                <hr class="my-5">

                <!-- form card cc payment -->
                <div class="card card-outline-secondary">
                    <div class="card-body">
                        <h4 class="text-center">Credit Card Payment</h4>
                        <hr>
                           <?php

                            if (isset($_SESSION['message'])): ?>
                            <div class="alert alert-<?=$_SESSION['msg_type']?>">

                              <?php
                                  echo $_SESSION['message'];
                                  unset($_SESSION['message']);
                              ?>

                          </div>
                        <?php endif ?>
                        <form action="payment.php?type=display&id=<?php echo $id; ?>&cartAmt=<?php echo $cartAmt.'&page='.$page; ?>" method="post" class="form" role="form" autocomplete="off">
                            <div class="form-group">
                                <label for="cc_name">Card Holder's Name</label>
                                <input type="text" class="form-control" id="cc_name" name="name" title="First and last name" placeholder="First and last name" >
                            </div>
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control" name="cNo" autocomplete="off" maxlength="20"  title="Credit card number" placeholder="Credit card number">
                            </div>
                            <div class="form-group row">
                                <label class="col-md-12">Card Exp. Date</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="cc_exp_mo" size="0">
                                        <option value="">Month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="cc_exp_yr" size="0">
                                        <option value="">Year</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                        <option>2021</option>
                                        <option>2022</option>
                                        <option>2023</option>
                                        <option>2024</option>
                                        <option>2025</option>
                                        <option>2026</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" name="CVC" class="form-control" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card"  placeholder="CVC">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-12">Amount</label>
                            </div>
                            <div class="form-inline">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">R</span></div>
                                    <input type="text" name="amountDue" readonly class="form-control text-right" value="<?php echo $cartAmt; ?>" id="exampleInputAmount" placeholder="39">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <a href="cart.php?id=<?php echo $id."&page=product"; ?>" type="button" class="btn btn-primary btn-lg btn-block">Cancel</a>

                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="btnPay" class="btn btn-success btn-lg btn-block">Pay</button>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>



                  <?php

                      if (isset($_POST['btnPay'])&&isset($_SESSION['custID']))
                      {



                            $name = $_POST['name'];
                            $cNo = $_POST['cNo'];
                            $cc_exp_mo = $_POST['cc_exp_mo'];
                            $cc_exp_yr = $_POST['cc_exp_yr'];
                            $CVC = $_POST['CVC'];
                            $amountDue = $_POST['amountDue'];


                              if (empty($name)&&empty($cNo)&&empty($cc_exp_mo)&&empty($cc_exp_yr)&&empty($CVC))
                              {


                                $_SESSION['message'] = "All field are empty";
                                $_SESSION['msg_type'] = "danger";
                                $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                echo "<script>location.replace('$ulr');</script>";
                                exit();
                              }
                              else
                              {
                                      if (!empty($name))
                                      {
                                              if (preg_match("/^[a-zA-Z\s]+$/",$name))
                                              {
                                                        if (!empty($cNo))
                                                        {
                                                              if (preg_match("/^[0-9\d]+$/",$cNo)&&strlen($cNo) >= 16)
                                                              {
                                                                        if (!empty($cc_exp_mo))
                                                                        {
                                                                                if (!empty($cc_exp_yr))
                                                                                {
                                                                                      if (!empty($CVC))
                                                                                      {
                                                                                            if (preg_match("/^[0-9\d]+$/",$CVC)&&strlen($CVC) == 3)
                                                                                            {

                                                                                                        if (isset($_SESSION['shop_Cart'])&&isset($_SESSION['custID']))
                                                                                                        {
                                                                                                          $orderNo = substr(uniqid('',true),-6);

                                                                                                          $totalDue = 0.0;
                                                                                                          foreach ($_SESSION['shop_Cart'] as $key => $value)
                                                                                                          {



                                                                                                                $itemT = $value['price'] * $value['quantity'];
                                                                                                                $totalDue = $totalDue +  $itemT;
                                                                                                                $itemname = $value['itemname'];
                                                                                                                $quantity = $value['quantity'];
                                                                                                                $price = $value['price'];
                                                                                                                $image = $value['image'];
                                                                                                                $item_Desr = $value['item_Desr'];

                                                                                                                $sql = "INSERT INTO customerorderitem(orderNumber,orderItemPrice,orderItemName,orderItemDestr,orderItemImg,orderItemQuant,orderItemTotal)
                                                                                                                      VALUES('$orderNo','$price','$itemname','$item_Desr','$image','$quantity','$itemT')";
                                                                                                                mysqli_query($conn,$sql);



                                                                                                          }

                                                                                                          $DATE = date('d-m-Y');

                                                                                                          $w = $_SESSION['custID'];
                                                                                                          $sql = "INSERT INTO customerorder(orderNumber,orderTotal,customerID,orderDate,storeID)
                                                                                                                VALUES('$orderNo','$totalDue','$w','$DATE','$id')";
                                                                                                          mysqli_query($conn,$sql);



                                                                                                          $sql = "INSERT INTO payment(paymentMethod,paymentAmount,orderNumber,paymentDate,customerID)
                                                                                                                VALUES('EFT Card','$totalDue','$orderNo','$DATE','$w')";
                                                                                                          mysqli_query($conn,$sql);

                                                                                                          $amt = $_SESSION['budgetAmt'];
                                                                                                          unset($_SESSION['budgetAmt']);

                                                                                                          $_SESSION['budgetAmt'] = $amt  -  $totalDue;
                                                                                                          $_SESSION['message'] = "Payment successfuly made";
                                                                                                          $_SESSION['msg_type'] = "success";

                                                                                                          $_SESSION['payS'] = "successPay";



                                                                                                          $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                                                                                          echo "<script>location.replace('$ulr');</script>";
                                                                                                          exit();


                                                                                                        }


                                                                                            }
                                                                                            else
                                                                                            {
                                                                                              $_SESSION['message'] = "Card CVC must be 3 digit ";
                                                                                              $_SESSION['msg_type'] = "danger";
                                                                                              $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                                                                              echo "<script>location.replace('$ulr');</script>";
                                                                                              exit();
                                                                                            }
                                                                                      }
                                                                                      else
                                                                                      {
                                                                                        $_SESSION['message'] = "Card CVC is empty";
                                                                                        $_SESSION['msg_type'] = "danger";
                                                                                        $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                                                                        echo "<script>location.replace('$ulr');</script>";
                                                                                        exit();
                                                                                      }
                                                                                }
                                                                                else
                                                                                {
                                                                                  $_SESSION['message'] = "Card year expiration is empty";
                                                                                  $_SESSION['msg_type'] = "danger";
                                                                                  $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                                                                  echo "<script>location.replace('$ulr');</script>";
                                                                                  exit();
                                                                                }
                                                                        }
                                                                        else
                                                                        {
                                                                          $_SESSION['message'] = "Card month expiration is empty";
                                                                          $_SESSION['msg_type'] = "danger";
                                                                          $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                                                          echo "<script>location.replace('$ulr');</script>";
                                                                          exit();
                                                                        }
                                                              }
                                                              else
                                                              {
                                                                    $_SESSION['message'] = "Card Number must be 16 or more digit Only ";
                                                                    $_SESSION['msg_type'] = "danger";
                                                                    $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                                                    echo "<script>location.replace('$ulr');</script>";
                                                                    exit();
                                                              }


                                                        }
                                                        else
                                                        {
                                                          $_SESSION['message'] = "Card Number is empty";
                                                          $_SESSION['msg_type'] = "danger";
                                                          $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                                          echo "<script>location.replace('$ulr');</script>";
                                                          exit();
                                                        }
                                              }
                                              else
                                              {
                                                    $_SESSION['message'] = "Card Holder's Name must be characters";
                                                    $_SESSION['msg_type'] = "danger";
                                                    $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                                    echo "<script>location.replace('$ulr');</script>";
                                                    exit();
                                              }
                                      }
                                      else
                                      {
                                        $_SESSION['message'] = "Card Holder's Name is empty";
                                        $_SESSION['msg_type'] = "danger";
                                        $ulr = 'payment.php?type=display&id='.$id.'&cartAmt='.$cartAmt."&page=product";
                                        echo "<script>location.replace('$ulr');</script>";
                                        exit();
                                      }
                              }




                      }

                  ?>


                  <?php


                        if (isset($_SESSION['payS'])&&$_SESSION['payS'] == "successPay")
                        {
                                echo "

                                <script type='text/javascript'>

                                var count = 6;
                                var redirect = 'index.php';

                                function countDown(){
                                var timer = document.getElementById('timer');
                                if(count > 0){
                                count--;
                                timer.innerHTML = 'This page will redirect in '+count+' seconds.';
                                setTimeout('countDown()', 1000);
                                }else{
                                window.location.href = redirect;
                                }
                                }
                                </script>


                                <br>

                                <span id='timer'>
                                <script type='text/javascript'>countDown();</script>
                                </span>

                                ";


                        }



                  ?>


  </body>
</html>
