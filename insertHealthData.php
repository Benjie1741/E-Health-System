<?php
require('includes/conn.inc.php');
session_start();

$userID = $_SESSION['chat_pID'];

$hoursOfSleep = $_POST['hoursOfSleep'];
$hoursOfExercise = $_POST['hoursOfExercise'];
$heartRate = $_POST['heartRate'];
$exerciseDone = $_POST['exerciseDone'];
$dateOfExercise = $_POST['doe'];

print $userID;

try {
	$sql=   "INSERT INTO healthdata 
            (userID, hoursOfSleep, hoursOfExercise, 
            heartRate, exerciseDone, dateOfExercise)
            VALUES 
            ($userID, $hoursOfSleep, $hoursOfExercise,
            $heartRate, '$exerciseDone', '$dateOfExercise')";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':hoursOfSleep', $hoursOfSleep);
            $stmt->bindParam(':hoursOfExercise', $hoursOfExercise);
            $stmt->bindParam(':heartRate', $heartRate);
            $stmt->bindParam(':exerciseDone', $exerciseDone);
            $stmt->bindParam(':dateOfExercise', $dateOfExercise);

            $stmt->execute();

	        header("Location: ./homePat.php");
}catch (\Exception $e) {

        print $e;

        $message = $e;
        echo "<script type='text/javascript'>alert('$message');
        location.href = 'homePat.php';
        </script>";
        //header("Location: ../eHealth/homeDoc.php");

//		header("Location: ../eHealth/register.php");
}

?>
