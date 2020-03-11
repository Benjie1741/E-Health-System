<?php
include('includes/conn.inc.php');

$email = $_POST['email'];

$password = $_POST['password'];
//$doctorID = $_POST['docID'];


$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {

	$sql= "INSERT INTO doctors (email, password)
       VALUES ('$email', '$hashed_password')";
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