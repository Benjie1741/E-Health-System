<?php
require('./includes/conn.inc.php');

$userPassword = $_POST['password'];
$email = $_POST['email'];

$hashed_password = password_hash($userPassword, PASSWORD_DEFAULT);


try {
	$sql = "UPDATE patients 
		    SET userPassword=:userPassword
            WHERE email = $email";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':userPassword', $hashed_password);

            $stmt->execute();

	        header("Location: ./login.php");
}catch (\Exception $e) {

        print $e;

        $message = $e;
        echo "<script type='text/javascript'>alert('$message');
        location.href = './login.php';
        </script>";
        header("Location: ./login.php");
}

?>
