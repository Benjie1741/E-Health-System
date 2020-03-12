<?php
require('includes/conn.inc.php');

    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($_POST['email'])) {

    if(!filter_input(INPUT_POST, 'email')){
        header("login.php");
    }
    else{
        $sql = "SELECT * FROM patients WHERE email = '$email'";
        $stmt = $pdo->query($sql);
        $row =$stmt->fetch(pdo::FETCH_ASSOC);
        $dbPasswordHash = password_verify($password, $row['password']);

        if($dbPasswordHash == true){

            echo "valid";
            $_SESSION['email'] = $email;
            $_SESSION['product_name'] =  [];
            $_SESSION['login'] = 1;
            $_SESSION['patientId'] = $row['PatientID'];
            $_SESSION['chatID'] = $row['PatientID'];
            $_SESSION['username'] = $row['PatientID'];
            header("Location: ../eHealth/homePat.php");
           
        }
        else{
            $message = "Email or password incorrect";
            echo "<script type='text/javascript'>alert('$message');
            location.href = 'login.php';
            </script>";
        }
    }
}
else{
            $message = "Email or password incorrect";
            echo "<script type='text/javascript'>alert('$message');
            location.href = 'login.php';
            </script>";
    }
?>
