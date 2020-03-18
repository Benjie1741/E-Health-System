<?php 
require('../includes/conn.inc.php');
require('../includes/functions.inc.php');
require('../includes/checkLoggedIn.php'); 

   echo '<script>';
   echo 'console.log('. json_encode( $_SESSION ) .')';
   echo '</script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/form.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="./homeDoc.php">E-Health</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="./homePat.php">Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="id01" class="">
  <form  action="../backend/changePatientPassword.php"  method="post">
    <div class="container" style="color: black">
      <h1>Change Password</h1>
      <p>Password must be at least 8 characters or longer and must contain at least one lowercase, uppercase, numeric and special character.</p>
      <hr>
      <input type='hidden' value='<?php echo $_SESSION['patientId']; ?>' name='pid'>

      <label for="oldPassword"><b>Old Password: </b></label>
      <input style="color: black" type="password" value="" name="oldPassword" required>

      <label for="newPassword"><b>New Password: </b></label>
      <input style="color: black" type="password" value="" name="newPassword" required > <!-- pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})" -->

      <label for="newPasswordAgain"><b>Type New Password Again:</b></label>
      <input style="color: black" type="password" value="" name="newPasswordAgain" required > <!-- pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})" -->

      <div class="clearfix">
        <button type="button" onclick="leave()" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Change Password</button>
      </div>
    </div>
  </form>
</div>

<script>
function leave()
{
   window.location.href = "../patient/homePat.php";
}
</script>

<footer class="container-fluid text-center">
    <p>Created by: Gustavo Sanchez, Arjun Grewal, Kenneth Alegria, Luke Midgley and Greg Smith</p>
    <p>Made with PHP, Bootstrap, JS and MySQL</p>
            <p>Contact information: <a href="mailto:gsanchezcollado@gmail.com">
              gsanchezcollado@gmail.com</a></p>
</footer>

</body>
</html>
