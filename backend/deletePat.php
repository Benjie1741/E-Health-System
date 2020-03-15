<?php
require('../includes/conn.inc.php');
session_start();

$pID = $_GET['pid'];

try {
            //Deletes patients health data
            $sql = "DELETE FROM `healthData` WHERE `healthData`.`userID` = $pID";            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':PatientID', $pID);
            $stmt->execute();
            
            //Deletes the patient
            $sql = "DELETE FROM `patients` WHERE `patients`.`PatientID` = $pID";            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':PatientID', $pID);
            $stmt->execute();

            header("Location: ../doctor/homeDoc.php");
            
}catch (\Exception $e) {
        print $e;
        $message = $e;
        echo "<script type='text/javascript'>alert('$message');
        location.href = '../doctor/homeDoc.php';
        </script>";
}
?>