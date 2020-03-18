<?php
require('./includes/conn.inc.php');

session_start();

$userPassword = $_POST['password'];
$email = $_SESSION['email'];

print $userPassword;
print $email;

$hashed_password = password_hash($userPassword, PASSWORD_DEFAULT);

try {
	$sql = "UPDATE `doctors` 
		SET userPassword=:userPassword
                WHERE email = '". $email . "'";
            
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
