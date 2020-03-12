<?php
include('includes/conn.inc.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];
$password = $_POST['password'];
$doctorID = $_POST['docID'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$age = $_POST['age'];
$address = $_POST['address'];
$num = $_POST['num'];
$blood = $_POST['blood'];
$dob = $_POST['dob'];
$history = $_POST['history'];
$illness = $_POST['illness'];
$prescription = $_POST['prescription'];
$allergies = $_POST['allergies'];

$emailInfo = 'Dear '.$_POST['firstname'].', <br><br> You have been registered as an E-Health patient by your GP.
Your login details are as follows: <br><br>
email: '.$_POST['email'].'<br>
password: '.$_POST['password'].'<br><br>

<a href="http://localhost/eHealth/">Click here to access the log in page</a>
 <br><br> Kind Regards,
 <br><br> The E-Health Team <br><br>';





$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {

	$sql= "INSERT INTO patients (email, password, doctorID, firstName, lastName, dateOfBirth, age, address, phoneNumber, bloodType, medicalHistory, allergies, prescription, illness)
       VALUES ('$email', '$hashed_password', '$doctorID', '$firstName', '$lastName', '$dob', '$age', '$address', '$num', '$blood', '$history', '$allergies', '$prescription', '$illness')";
       $stmt = $pdo -> query($sql);
	  
	   header("Location: ../eHealth/homeDoc.php");
   //Load Composer's autoloader
	require 'vendor/autoload.php';

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
	$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ehealth52@gmail.com';                 // SMTP username
    $mail->Password = '123ehealth';                           // SMTP password
    $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
	
		//Recipients
		$mail->setFrom('ehealth52@gmail.com', 'E-Health');
		$mail->addAddress($email, $firstName);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
	
		// Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('./chat-icon.png', 'chat-icon.png');    // Optional name
	
		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Welcome to E-Health';
		//$mail->AddEmbeddedImage('chat-icon.png', 'logoimg', 'chat-icon.png'); // attach file
		$mail->Body    = $emailInfo;
		  
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
		$mail->send();
		echo 'Message has been sent';

    header("Location: homeDoc.php");

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

    header("Location: homeDoc.php");
}

}
catch (\Exception $e) {
    	
    	$message = "Email Already Exists!";
		echo "<script type='text/javascript'>alert('$message');
		location.href = 'homeDoc.php';
		</script>";

//		header("Location: ../WebShop/register.php");
}


?>