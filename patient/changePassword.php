<?php 
require('../includes/conn.inc.php');
require('../includes/checkLoggedIn.php'); 

   echo '<script>';
   echo 'console.log('. json_encode( $_SESSION ) .')';
   echo '</script>';

ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/themes.css">
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
      <a class="navbar-brand" href="./homePat.php">E-Health</a>
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
  <form  action="../backend/changePassword.php"  method="post">
    <div class="container" style="color: black">
      <h1>Change your password</h1>
      <p>Please edit this form to update your password</p>
      <hr>

      <label for="address"><b>You must enter your old password to change your new password: </b></label>
      <input style="color: black" type="text" name="oldPass" required>

      <label for="phoneNumber"><b>New : </b></label>
      <input style="color: black" type="text" name="newPass1" required>

      <label for="email"><b>Re-Enter Password:</b></label>
      <input style="color: black" type="text" name="newPass2" required>

      <div class="clearfix">
        <button type="button" onclick="leave()" class="cancelbtn">Cancel</button>
        <button type="submit"  class="signupbtn">Edit</button>
      </div>
    </div>
  </form>
</div>

<script>
function leave()
{
   window.location.href = "./homePat.php";
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

<script>
  window.onload = function(){
    var t = "<?php echo $_SESSION['theme']; ?>";
    var f = "<?php echo $_SESSION['font']; ?>";
    var s = "<?php echo $_SESSION['textSize']; ?>";

    console.log(t + f + s);
    document.body.classList.toggle(t);
    document.body.style.fontFamily = f;
    document.body.style.fontSize = s;
  }
</script>