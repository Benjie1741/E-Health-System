<?php
  //Checks to see if the user is logged im, to prevent unauthorised access to certain pages
  session_start();
  if($_SESSION["login"]!=1){
  header("Location: ../login.php");
  }
?>