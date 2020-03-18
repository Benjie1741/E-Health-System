<?php

function checkDrTable($email)
{
    require('./includes/conn.inc.php');
    //check table for the email
    $sql = "SELECT * FROM `doctors` WHERE `email` = '". $email. "'";

    $stmt = $pdo->prepare($sql);

    //catch any errors when the sql is ran
    if($stmt->execute()){
        echo "<div class='alert alert-success'>Checking Dr Table completed.</div>";
    }else{
        echo "<div class='alert alert-danger'>Unable to check Dr Table .</div>";
    }
}

function checkPatTable($email)
{
    require('./includes/conn.inc.php');
    //check table for the email
    $sql = "SELECT * FROM `patients` WHERE `email` = '". $email. "'";
    
    $stmt = $pdo->prepare($sql);
    //catch any errors when the sql is ran
    if($stmt->execute()){
        echo "<div class='alert alert-success'>Checking Pat Table completed.</div>";
    }else{
        echo "<div class='alert alert-danger'>Unable to check Pat Table .</div>";
    }
}

function resetDrPassword($email, $password)
{
    require('./includes/conn.inc.php');
    //hash password first before sending to db
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //update only password
    $sql = "UPDATE `doctors` 
	SET userPassword=:userPassword
    WHERE email = '". $email . "'";
           
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':userPassword', $hashed_password);
    //catch any errors
    if($stmt->execute()){
        echo "<div class='alert alert-success'>Password is updated.</div>";
    }else{
        echo "<div class='alert alert-danger'>Unable to update password.</div>";
    }
}

function resetPatPassword($email, $password)
{
    require('./includes/conn.inc.php');
    //hash password first before sending to db
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE patients 
    SET userPassword=:userPassword
    WHERE email = '". $email . "'";
    
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':userPassword', $hashed_password);
    //catch any errors
    if($stmt->execute()){
        echo "<div class='alert alert-success'>Password is updated.</div>";
    }else{
        echo "<div class='alert alert-danger'>Unable to update password.</div>";
    }
}

?>