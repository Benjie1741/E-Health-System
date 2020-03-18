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
        $sql = "SELECT * FROM doctors WHERE email = '$email'";
        $stmt = $pdo->query($sql);
        $row =$stmt->fetch(pdo::FETCH_ASSOC);
        if ($row == "") {
            $message = "Email Not Found";
            echo "<script type='text/javascript'>alert('$message');
            location.href = '../login.php';
            </script>";
        } else {
        $dbPasswordHash = password_verify($password, $row['userPassword']);

        if($dbPasswordHash == true){

            echo "valid";
            $_SESSION['email'] = $email;
            $_SESSION['login'] = 1;
            $_SESSION['DoctorID'] = $row['DoctorID'];

            //sessions for chat
            $_SESSION['username'] = $row['firstName'];
            $_SESSION['chat_dID'] = $row['DoctorID'];
            $_SESSION['chat_pID'] = null;
            $_SESSION['redirect'] = "../doctor/homeDoc.php";
            $_SESSION['msgTime'] = null;
            $_SESSION['isDoctorOrPatient'] = "D";

            //Session for individual part
            $_SESSION['theme'] = null;
            $_SESSION['textSize'] = null;
            $_SESSION['font'] = null;
            
            header("Location: ../login.php");
           
        }
        else{
            $message = "Email or password incorrect";
            echo "<script type='text/javascript'>alert('$message');
            location.href = '../login.php';
            </script>";
        }
      }
    }
}
else{
            $message = "Email or password incorrect";
            echo "<script type='text/javascript'>alert('$message');
            location.href = '../login.php';
            </script>";
    }
?>
