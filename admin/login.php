<?php

include_once "database/dbConn.php";
session_start();

if (isset($_POST['btnLoginA']))
{

      $email = $_POST['email'];
      $password = $_POST['password'];



      if (empty($email)&&empty($password))
      {

        $_SESSION['message'] = "All Field are empty";
        $_SESSION['msg_type'] = "danger";

        echo "<script>location.replace('../index.html');</script>";
        exit();
      }


      if (!empty($email))
      {
              if (filter_var($email, FILTER_VALIDATE_EMAIL))
              {
                      if (!empty($password))
                      {

                            $sql = "SELECT* FROM admin WHERE adminEmail = '$email';";
                            $result = mysqli_query($conn,$sql);
                            if (mysqli_num_rows($result)== 1)
                            {
                                    $row = mysqli_fetch_assoc($result);
                                    if ($password == $row['adminPwd'])
                                    {
                                      $_SESSION['adminID'] = $row['adminID'];
                                      $_SESSION['adminEmail'] = $row['adminEmail'];
                                      $_SESSION['adminStoreID'] = $row['storeID'];
                                      echo '<script>alert("Successfully Login")</script>';
                                      echo "<script>location.replace('index.php');</script>";
                                      exit();
                                    }
                                    else
                                    {
                                      $_SESSION['message'] = "Admin password is incorrect";
                                      $_SESSION['msg_type'] = "danger";
                                      echo '<script>alert("Admin password is incorrect")</script>';
                                      echo "<script>location.replace('../index.html');</script>";
                                      exit();

                                    }
                            }
                            else
                            {
                              $_SESSION['message'] = "Admin is not registered";
                              $_SESSION['msg_type'] = "danger";
                              echo '<script>alert("Admin is not registered")</script>';
                              echo "<script>location.replace('../index.html');</script>";
                              exit();
                            }



                      }
                      else
                      {
                        $_SESSION['message'] = "Password field is empty";
                        $_SESSION['msg_type'] = "danger";
                        echo '<script>alert("Password field is empty")</script>';
                        echo "<script>location.replace('../index.html');</script>";
                        exit();

                      }
              }
              else
              {

                $_SESSION['message'] = "email field format is incorrect";
                $_SESSION['msg_type'] = "danger";
                echo '<script>alert("email field format is incorrect")</script>';
                echo "<script>location.replace('../index.html');</script>";
                exit();

              }
      }
      else
      {

        $_SESSION['message'] = "Field email is empty";
        $_SESSION['msg_type'] = "danger";
        echo '<script>alert("Field email is empty")</script>';
        echo "<script>location.replace('../index.html');</script>";
        exit();

      }



}


?>
