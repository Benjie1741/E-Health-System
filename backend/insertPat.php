<?php
include('../includes/conn.inc.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();

$email = $_POST['email'];
$userPassword = $_POST['password'];
$doctorID = $_SESSION['DoctorID'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$age = $_POST['age'];
$userAddress = $_POST['address'];
$num = $_POST['num'];
$blood = $_POST['blood'];
$dob = $_POST['dob'];
$history = $_POST['history'];
$illness = $_POST['illness'];
$prescription = $_POST['prescription'];
$allergies = $_POST['allergies'];

$file = base64_encode(file_get_contents($_FILES["image"]["tmp_name"]));

echo '<script>console.log('.json_encode($file).')</script>';

$hashed_password = password_hash($userPassword, PASSWORD_DEFAULT);

try {

       $sql= "INSERT INTO patients (email, userPassword, doctorID, firstName, lastName, dateOfBirth, age, userAddress, phoneNumber, bloodType, medicalHistory, allergies, prescription, illness, imageFile)
       VALUES ('$email', '$hashed_password', '$doctorID', '$firstName', '$lastName', '$dob', '$age', '$userAddress', '$num', '$blood', '$history', '$allergies', '$prescription', '$illness', '$file')";
       $stmt = $pdo -> query($sql);
	   header("Location: ../doctor/homeDoc.php");
    }catch (\Exception $e) {
    	
    	$message = $e;
		echo "<script type='text/javascript'>alert('$message');
		location.href = '../doctor/homeDoc.php';
		</script>";
}

?>
