<?php 
require('../includes/conn.inc.php');
require('../includes/functions.inc.php');
require('../includes/checkLoggedIn.php'); 

   echo '<script>';
   echo 'console.log('. json_encode( $_SESSION ) .')';
   echo '</script>';

ini_set('display_errors', 1);

$hid = $_GET['hid'];
$patientID = $_GET['pid'];
$sql = "SELECT * FROM `healthdata` where `userID` = " . $patientID . " AND `healthDataID` = " . $hid;
$result = $pdo->query($sql);
$row = $result->fetchObject();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit health data</title>
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
        <li><a href="./homeDoc.php">Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="id01" class="">
  <form  action="../backend/editHealthData.php"  method="post">
    <div class="container">
      <h1>Edit patient health data</h1>
      <p>Please edit this form to update health data</p>
      <?php
        #get healthdataID from url variable
        $patientID = $_SESSION['PatientID'];
        $hid = $_GET['hid'];
      ?>
      <hr>
      <input type='hidden' value='<?php echo $hid; ?>' name='hid'>
      <input type='hidden' value='<?php echo $patientID; ?>' name='pid'>

      <label for="hoursOfSleep"><b>Hours of sleep: </b></label>
      <input type="number" placeholder="<?php print $row->hoursOfSleep ?>" name="hoursOfSleep" required min="0" max="24">

      <label for="lastName"><b>Hours of exercise: </b></label>
      <input type="number" placeholder="<?php print $row->hoursOfExercise?>" name="hoursOfExercise" required min="0" max="24">

      <label for="heartRate"><b>Average daily heart rate (BPM):</b></label>
      <input type="number" placeholder="<?php print $row->heartRate?>" name="heartRate" required min="50" max="140">

      <label for="exerciseDone"><b>Exercise Done: </b></label>
      <input type="text" placeholder="<?php print $row->exerciseDone?>" name="exerciseDone" required pattern="[A-Za-z]{1,15}">

      <label for="dateOfExercise"><b>Date of exercise: </b></label>
      <input type="date" placeholder="<?php print $row->dateOfExercise?>" name="doe" required>

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
   window.location.href = "./homeDoc.php";
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
