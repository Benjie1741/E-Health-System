<?php
require('../includes/conn.inc.php');
session_start();
#To make the changes even when the user logs out
$PatientID = $_SESSION['patientId'];
$theme = $_POST['Theme'];
$textSize = $_POST['Text'];
$font = $_POST['Font'];

#To make the changes now
$_SESSION['theme'] = $theme;
$_SESSION['textSize'] = $textSize;
$_SESSION['font'] = $font;

try {
	$sql = "UPDATE patients 
			SET PatientID=:PatientID,
                theme=:theme,
				textSize=:textSize,
                font=:font

            WHERE PatientID = $PatientID";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':PatientID', $PatientID);
            $stmt->bindParam(':theme', $theme);
            $stmt->bindParam(':textSize', $textSize);
            $stmt->bindParam(':font', $font);

            $stmt->execute();

            header("Location: ../patient/homePat.php");
            
}catch (\Exception $e) {
        print $e;
        echo $e;
        header("Location: ../patient/homePat.php");
}
?>
