<?php
//Description: Destroys the users session and redirects to the login screen.
    session_start();
    $_SESSION = array();
    session_destroy();
    header("Location: ./login.php");
?>