<?php
include('includes/conn.inc.php');

$email = $_POST['email'];

$password = $_POST['password'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$age = $_POST['age'];
$address = $_POST['address'];
$num = $_POST['num'];
$clearance = $_POST['clearance'];
$dob = $_POST['dob'];
$license = $_POST['license'];
$specialty = $_POST['specialty'];



$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {

	$sql= "INSERT INTO doctors (email, password, firstName, lastName, dateOfBirth, age, address, phoneNumber, clearanceLevel, licenseRevalidationDate, specialty)
       VALUES ('$email', '$hashed_password', '$firstName', '$lastName', '$dob', '$age', '$address', '$num', '$clearance', '$license', '$specialty')";
       $stmt = $pdo -> query($sql);
       header("Location: ../eHealth/homeDoc.php");
}catch (\Exception $e) {
    	
    $message = "Email Already Exists!";
    echo "<script type='text/javascript'>alert('$message');
    location.href = 'homeDoc.php';
    </script>";

//		header("Location: ../eHealth/register.php");
}
?>