<?php
require('includes/conn.inc.php');

$healthDataID = $_POST['hid'];
$userID = $_POST['pid'];
$hoursOfSleep = $_POST['hoursOfSleep'];
$hoursOfExercise = $_POST['hoursOfExercise'];
$heartRate = $_POST['heartRate'];
$exerciseDone = $_POST['exerciseDone'];
$dateOfExercise = $_POST['doe'];

try {
	$sql = "UPDATE healthdata 
			SET healthDataID=:healthDataID, userID=:userID,
				hoursOfSleep=:hoursOfSleep, hoursOfExercise=:hoursOfExercise,
				heartRate=:heartRate, exerciseDone=:exerciseDone,
				dateOfExercise=:dateOfExercise
            WHERE healthDataID = $healthDataID";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':healthDataID', $healthDataID);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':hoursOfSleep', $hoursOfSleep);
            $stmt->bindParam(':hoursOfExercise', $hoursOfExercise);
            $stmt->bindParam(':heartRate', $heartRate);
            $stmt->bindParam(':exerciseDone', $exerciseDone);
            $stmt->bindParam(':dateOfExercise', $dateOfExercise);

            $stmt->execute();

	        header("Location: ../eHealth/homePat.php");
}catch (\Exception $e) {

        print $e;

        $message = $e;
        echo "<script type='text/javascript'>alert('$message');
        location.href = 'homeDoc.php';
        </script>";
        //header("Location: ../eHealth/homeDoc.php");

//		header("Location: ../eHealth/register.php");
}

?>