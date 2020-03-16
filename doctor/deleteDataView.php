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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delete Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/doc.css">
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
  <form  action="../backend/deleteHealthData.php"  method="post">
    <div class="container">
      <h1>Delete patient health data?</h1>
      <p>Are you sure you want to delete this patient data?</p>
      <?php
        #get healthdataID from url variable
        $patientID = $_SESSION['PatientID'];
        $hid = $_GET['hid'];
      ?>
      <hr>
      <table id="myTable" class= "table" style=" border: 2px solid black;">
                    <tr>
                        <td>Date</td>
                        <td>Hours of Sleep</td>
                        <td>Hours of Exercise</td>
                        <td>Heart Rate</td>
                        <td>Exercise Done</td>                                        
                    </tr>
            <?php
               while($row = $result->fetchObject()) {
                   echo "<tr>";
                       echo "<td>$row->dateOfExercise</td>";
                       echo "<td>$row->hoursOfSleep</td>";
                       echo "<td>$row->hoursOfExercise</td>";
                       echo "<td>$row->heartRate</td>";
                       echo "<td>$row->exerciseDone</td>";
                   echo "</tr>";
                 }
            ?>
            </table>

      <div class="clearfix">
        <button type="button" onclick="leave()" class="cancelbtn">Cancel</button>
        <button type="submit"  class="signupbtn">Delete</button>
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
