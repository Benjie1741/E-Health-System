<?php
require('../includes/conn.inc.php');

$newPassword = $_POST['newPassword'];
$newPasswordAgain = $_POST['newPasswordAgain'];
$oldPassword = $_POST['oldPassword'];
$pid = $_POST['pid'];

echo '<script>console.log('.json_encode($oldPassword).')</script>';
echo '<script>console.log('.json_encode($newPassword).')</script>';
echo '<script>console.log('.json_encode($newPasswordAgain).')</script>';
echo '<script>console.log('.json_encode($pid).')</script>';

$sql = "SELECT `userPassword` FROM patients WHERE PatientID = ". $pid;
$result = $pdo->query($sql);

echo '<script>console.log('.json_encode($result->fetchObject()).')</script>';

if ($dbPasswordHash = password_verify($oldPassword, $result->fetchObject()))
{
    $message = "Password is Incorrect";
        echo "<script type='text/javascript'>alert('$message');
        location.href = '../patient/changePassword.php';
        </script>";
}
else if ($newPassword != $newPasswordAgain)
{
    $message = "Passwords do not match!";
        echo "<script type='text/javascript'>alert('$message');
        location.href = '../patient/changePassword.php';
        </script>";
}
else 
{
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
    echo '<script>console.log('.json_encode($hashed_password).')</script>';
    try {
        $sql = "UPDATE patients 
                SET userPassword=:newPassword
                WHERE PatientID = $pid";
                
                $stmt = $pdo->prepare($sql);  
                $stmt->bindParam(':newPassword', $hashed_password);
                $stmt->execute();

                echo '<script>console.log('.json_encode($sql).')</script>';

                $message = "Password has been Changed!";
                echo "<script type='text/javascript'>alert('$message');
                location.href = '../patient/homePat.php';
                </script>";
    }catch (\Exception $e) {
    
            print $e;
            
            $message = $e;
            echo "<script type='text/javascript'>alert('$message');
            location.href = '../patient/homePat.php';
            </script>";
    }
}

?>
