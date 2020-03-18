<?php
require('./includes/conn.inc.php');

session_start();

//get relevant data 
$userPassword = $_POST['password'];
$email = $_SESSION['email'];

//hash new password before sending to db
$hashed_password = password_hash($userPassword, PASSWORD_DEFAULT);

try {
        //update only password
	$sql = "UPDATE `doctors` 
		SET userPassword=:userPassword
                WHERE email = '". $email . "'";
            
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':userPassword', $hashed_password);

                if($stmt->execute()){
                        echo "<div class='alert alert-success'>Password is updated.</div>";
                }else{
                        echo "<div class='alert alert-danger'>Unable to update password.</div>";
                }

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
