<?php
   session_start();

require('includes/conn.inc.php');

$healthDataID = $_GET['hid'];
$userID = $_SESSION['PatientID'];

print $healthDataID;
print $userID;

try {
            $sql = "DELETE FROM healthData WHERE userID = $userID 
                    AND healthDataID = healthDataID";

            
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':healthDataID', $healthDataID);
            $stmt->bindParam(':userID', $userID);

            $stmt->execute();

	        header("Location: ./homeDoc.php");
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