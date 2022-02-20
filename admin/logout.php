<?php
  session_start();
  session_destroy();
  unset($_SESSION['adminID']);
  unset($_SESSION['adminEmail']);
  echo '<script>alert("Successfully logged out")</script>';
  echo "<script>location.replace('../index.html');</script>";
  exit();

?>
