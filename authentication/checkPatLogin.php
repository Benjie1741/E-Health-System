<?php
require('../includes/conn.inc.php');

    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($_POST['email'])) {

    if(!filter_input(INPUT_POST, 'email')){
        header("../login.php");
    }
    else{
        $sql = "SELECT * FROM patients WHERE email = '$email'";
        $stmt = $pdo->query($sql);
        $row =$stmt->fetch(pdo::FETCH_ASSOC);
        $dbPasswordHash = password_verify($password, $row['userPassword']);

        if($dbPasswordHash == true){

            echo "valid";
            $_SESSION['email'] = $email;
            $_SESSION['login'] = 1;
            $_SESSION['patientId'] = $row['PatientID'];
            
            //Sessions for chat
            $_SESSION['username'] = $row['firstName'];
            $_SESSION['chat_pID'] = $row['PatientID'];
            $_SESSION['chat_dID'] = $row['doctorID'];
            $_SESSION['redirect'] = "../patient/homePat.php";
            $_SESSION['msgTime'] = null;

            header("Location: ../patient/homePat.php");
           
        }
        else{
            $message = "Email or password incorrect";
            echo "<script type='text/javascript'>alert('$message');
            location.href = '../login.php';
            </script>";
        }
    }
}
else{
            $message = "Email or password incorrect";
            echo "<script type='text/javascript'>alert('$message');
            location.href = './login.php';
            </script>";
    }
?>
