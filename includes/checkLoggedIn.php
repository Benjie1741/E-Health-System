<?php 
    session_start();
    $found=false;
   if($_SESSION["login"]==1){
     $found=true;
   }
   if($found==false){
     header("Location: ./login.php");
   }
?>