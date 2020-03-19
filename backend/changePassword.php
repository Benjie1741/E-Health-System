<?php
require('../includes/conn.inc.php');
session_start();
#To make the changes even when the user logs out
$PatientID = $_SESSION['patientId'];
$oldPassword = $_POST['oldPass'];
$newPassword = $_POST['newPass1'];
$comparePass = $_POST['newPass2'];

if($newPassword != $comparePass){
        $message = "Passwords dont match";
        echo "<script type='text/javascript'>alert('$message');
        location.href = '../patient/changePassword.php';
        </script>";

}else{
        $sql = "SELECT * FROM patients WHERE PatientID = '$PatientID'";
        $stmt = $pdo->query($sql);
        $row =$stmt->fetch(pdo::FETCH_ASSOC);
        $dbPasswordHash = password_verify($oldPassword, $row['userPassword']);

        if($dbPasswordHash == true){ 
                $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
                try {
                        $sql = "UPDATE patients 
                                SET PatientID=:PatientID,
                                    userPassword=:userPassword
                
                            WHERE PatientID = $PatientID";
                
                            $stmt = $pdo->prepare($sql);
                
                            $stmt->bindParam(':PatientID', $PatientID);
                            $stmt->bindParam(':userPassword', $hashed_password);
                
                            $stmt->execute();
                
                            header("Location: ../patient/homePat.php");
                            
                }catch (\Exception $e) {
                        $message = "Error Please Try Again";
                        echo "<script type='text/javascript'>alert('$message');
                        location.href = '../patient/changePassword.php';
                        </script>";
                }
        } else {
                $message = "Incorrect Password";
                echo "<script type='text/javascript'>alert('$message');
                location.href = '../patient/changePassword.php';
                </script>";
        }

}

?>
