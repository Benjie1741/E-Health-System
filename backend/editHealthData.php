<?php
//Description: Edit a patient's health data.
//Called by: editDataForm.php Line 56

require('../includes/conn.inc.php');

$healthDataID    = $_POST['hid'];
$hoursOfSleep    = $_POST['hoursOfSleep'];
$hoursOfExercise = $_POST['hoursOfExercise'];
$heartRate       = $_POST['heartRate'];
$exerciseDone    = $_POST['exerciseDone'];
$dateOfExercise  = $_POST['doe'];

try {
    $sql = "UPDATE healthdata 
            SET healthDataID=:healthDataID,
                hoursOfSleep=:hoursOfSleep, hoursOfExercise=:hoursOfExercise,
                heartRate=:heartRate, exerciseDone=:exerciseDone,
                dateOfExercise=:dateOfExercise
            WHERE healthDataID = $healthDataID";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':healthDataID', $healthDataID);
    $stmt->bindParam(':hoursOfSleep', $hoursOfSleep);
    $stmt->bindParam(':hoursOfExercise', $hoursOfExercise);
    $stmt->bindParam(':heartRate', $heartRate);
    $stmt->bindParam(':exerciseDone', $exerciseDone);
    $stmt->bindParam(':dateOfExercise', $dateOfExercise);
    
    $stmt->execute();
    
    header("Location: ../doctor/homeDoc.php");
}
catch (\Exception $e) {
    
    print $e;
    
    $message = $e;
    echo "<script type='text/javascript'>alert('$message');
        location.href = '../doctor/homeDoc.php';
        </script>";
    header("Location: ../doctor/homeDoc.php");
}

?>