<?php
  session_start();
  session_destroy();
  unset($_SESSION['custID']);
  unset($_SESSION['custEmail']);
  unset($_SESSION['budgetAmt']);

  echo "<script>location.replace('../index.html');</script>";
  exit();

?>
