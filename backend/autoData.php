<?php 
//Description: Takes patient data from the "sensor" and uploads it to the database
//Called by: homePat.php Line 119.

include('includes/conn.inc.php');
require('includes/functions.inc.php');
session_start();

$userID = $_SESSION['chat_pID'];
$hoursOfSleep = safeInt($_GET['hoursOfSleep']);
$hoursOfExercise = safeInt($_GET['hoursOfExercise']);
$heartRate = safeInt($_GET['heartRate']); 
$exerciseDone = safeString($_GET['exerciseDone']);

$dateOfExercise = "2020-03-20";

$query = $pdo->prepare("INSERT INTO healthData SET userID=?, hoursOfSleep=?, hoursOfExercise=?, heartRate=?, exerciseDone=?, dateOfExercise=?");
$run = $query->execute([$userID, $hoursOfSleep, $hoursOfExercise, $heartRate, $exerciseDone, $dateOfExercise]);

if ( $run ) {
    echo 1;
    exit;
  }
?>