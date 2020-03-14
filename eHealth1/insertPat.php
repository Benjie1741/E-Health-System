<?php
include('includes/conn.inc.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];

$password = $_POST['password'];
$doctorID = $_POST['docID'];


$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {

	$sql= "INSERT INTO patients (email, password, doctorID)
       VALUES ('$email', '$hashed_password', '$doctorID')";
       $stmt = $pdo -> query($sql);
	   header("Location: ./homeDoc.php");
    }catch (\Exception $e) {
    	
    	$message = "Email Already Exists!";
		echo "<script type='text/javascript'>alert('$message');
		location.href = 'homeDoc.php';
		</script>";

//		header("Location: ../eHealth/register.php");
}

?>