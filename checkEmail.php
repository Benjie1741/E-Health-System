<?php
require('./includes/conn.inc.php');

session_start();

$email = $_POST['email'];
$_SESSION['email'] = $email;

require_once "C:/Users/Kenneth Alegria/vendor/autoload.php";

try {
            $sql = "SELECT * FROM `doctors` WHERE `email` = '". $email. "'";
            $result = $pdo->query($sql);
            //check email in doctors table
            if(count($result) > 0)
            {
                //PHPMailer Object
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                
                //Enable SMTP debugging. 
                $mail->SMTPDebug = 3;                               
                //Set PHPMailer to use SMTP.
                $mail->isSMTP();            
                //Set SMTP host name                          
                $mail->Host = "smtp.gmail.com";
                //Set this to true if SMTP host requires authentication to send email
                $mail->SMTPAuth = true;                          
                //Provide username and password     
                $mail->Username = "eHealthApp2020@gmail.com";                 
                $mail->Password = "eHealth123";                           
                //If SMTP requires TLS encryption then set it
                $mail->SMTPSecure = "tls";                           
                //Set TCP port to connect to 
                $mail->Port = 587;                                   
                //Set email information
                $mail->From = "eHealthApp2020@gmail.com";
                $mail->FromName = "The eHealth team";
                //Set target email - Hard coded mine in as an example
                $mail->addAddress("b6035314@my.shu.ac.uk");

                $mail->isHTML(true);
                //Set email content
                $mail->Subject = "PasswordReset";
                $mail->Body = "<i>Please click this link to reset your password</i>";
                $mail->AltBody = "Please click this link to reset your password";
                //catch any errors then redirect
                if(!$mail->send()) 
                {
                    echo "Mailer Error: " . $mail->ErrorInfo;

                    echo '<script language="javascript">';
                    echo 'alert("Mailer error!")';
                    echo '</script>';
                    echo '<script lanuage="javascript">';
                    echo 'location.replace("./login.php")';
                    echo  '</script>';
                } 
                else 
                {
                    echo "Message has been sent successfully";
                    echo '<script lanuage="javascript">';
                    echo 'location.replace("./newPasswordDr.php")';
                    echo  '</script>';
                }
            }
            //check email in patients table if not in doctors table
            else
            {
                $sql = "SELECT * FROM `patients` WHERE `email` = '". $email. "'";
                $result = $pdo->query($sql);
                if(count($result) > 0)
                {
                    //PHPMailer Object
                    $mail = new PHPMailer\PHPMailer\PHPMailer();
                    
                    //Enable SMTP debugging. 
                    $mail->SMTPDebug = 3;                               
                    //Set PHPMailer to use SMTP.
                    $mail->isSMTP();            
                    //Set SMTP host name                          
                    $mail->Host = "smtp.gmail.com";
                    //Set this to true if SMTP host requires authentication to send email
                    $mail->SMTPAuth = true;                          
                    //Provide username and password     
                    $mail->Username = "eHealthApp2020@gmail.com";                 
                    $mail->Password = "eHealth123";                           
                    //If SMTP requires TLS encryption then set it
                    $mail->SMTPSecure = "tls";                           
                    //Set TCP port to connect to 
                    $mail->Port = 587;                                   
                    //Set email information
                    $mail->From = "eHealthApp2020@gmail.com";
                    $mail->FromName = "The eHealth team";
                    //Set target email - Hard coded mine in as an example
                    $mail->addAddress("b6035314@my.shu.ac.uk");

                    $mail->isHTML(true);
                    //Set email content
                    $mail->Subject = "PasswordReset";
                    $mail->Body = "<i>Please click this link to reset your password</i>";
                    $mail->AltBody = "Please click this link to reset your password";
                    //catch any errors then redirect
                    if(!$mail->send()) 
                    {
                        echo "Mailer Error: " . $mail->ErrorInfo;

                        echo '<script language="javascript">';
                        echo 'alert("Mailer error!")';
                        echo '</script>';
                        echo '<script lanuage="javascript">';
                        echo 'location.replace("./login.php")';
                        echo  '</script>';
                    }
                    else 
                    {
                        echo "Message has been sent successfully";
                        echo '<script lanuage="javascript">';
                        echo 'location.replace("./newPasswordPat.php")';
                        echo  '</script>';
                    }
                }
                //If it didnt find the same email in db, redirect
                else
                {
                    echo '<script language="javascript">';
                    echo 'alert("Email not found!")';
                    echo '</script>';
                    echo '<script lanuage="javascript">';
                    echo 'location.replace("./login.php")';
                    echo  '</script>';
                }
            }
}catch (\Exception $e) {

        print $e;

        $message = $e;
        echo "<script type='text/javascript'>alert('$message');
        location.href = './login.php';
        </script>";
        echo '<script lanuage="javascript">';
        echo 'location.replace("./login.php")';
        echo  '</script>';
}

?>
