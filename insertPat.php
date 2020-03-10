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
   	  

//Load Composer's autoloader
	require 'vendor/autoload.php';

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'drinkshop41@gmail.com';                 // SMTP username
    $mail->Password = 'Testtest-1';                           // SMTP password
    $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('drinkshop41@gmail.com', 'Drinks Shop');
    $mail->addAddress($email, $name);     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Thank you for registering';
    $mail->Body    = 'Thank you for registering to our site';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';

    header("Location: ../eHealth/homePat.php");

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

    header("Location: ../eHealth/homePat.php");
}

}
catch (\Exception $e) {
    	
    	$message = "Email Already Exists!";
		echo "<script type='text/javascript'>alert('$message');
		location.href = 'homeDoc.php';
		</script>";

//		header("Location: ../eHealth/register.php");
}

?>