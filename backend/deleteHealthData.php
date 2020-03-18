<?php
//Description: Deletes specific health data for a patient.
//Called by: deleteDataView.php Line 52.

require('../includes/conn.inc.php');
session_start();

$healthDataID = $_GET['hid'];
$userID       = $_SESSION['chat_pID'];

try {
    $sql = "DELETE FROM `healthData` WHERE `userID` = $userID 
                AND `healthDataID` = $healthDataID";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':healthDataID', $healthDataID);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    
    header("Location: ../doctor/homeDoc.php");
    
}
catch (\Exception $e) {
    
    print $e;
    $message = $e;
    echo "<script type='text/javascript'>alert('$message');
        location.href = '../doctor/homeDoc.php';
        </script>";
    
}
?>