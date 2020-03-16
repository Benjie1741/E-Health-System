<?php 
require('../includes/conn.inc.php');
require('../includes/functions.inc.php');
require('../includes/checkLoggedIn.php'); 

  echo '<script>';
  echo 'console.log('. json_encode( $_SESSION ) .')';
  echo '</script>';

ini_set('display_errors', 1);

$sql =  "SELECT *  FROM `patients` where `PatientID` = " . $_GET["pid"];
$result = $pdo->query($sql);
$sql1 = "SELECT * FROM `healthdata` where `userID` = " . $_GET["pid"];
$result1 = $pdo->query($sql1);
$sql2 =  "SELECT *  FROM `patients` where `PatientID` = " . $_GET["pid"];
$result2 = $pdo->query($sql);

$_SESSION['chat_pID'] = $_GET["pid"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Selected Patient</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/doc.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Search -->
  <script>
      $(document).ready(function(){
          $('.search').on('keyup',function(){
              var searchTerm = $(this).val().toLowerCase();
              $('#myTable tbody tr').each(function(){
                  var lineStr = $(this).text().toLowerCase();
                  if(lineStr.indexOf(searchTerm) === -1){
                      $(this).hide();
                  }else{
                      $(this).show();
                  }
              });
          });
      });
</script>
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
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    <!-- Button for chat, displays the name of the patient -->
    <button onclick="window.location.href = '../chat/chat.php';"style="width:auto; background-color: #00acee;"> Chat with
    <?php while($row = $result2->fetchObject()) {echo "$row->firstName";}?>
    </button>
    
    </div>
    <div class="col-sm-8 text-left"> 
    <div id="patientList" class="bg-1">
              
                <h3 class="text-center">Patient List</h3>
                <p class="text-center">In this section you can find a list of your patients!</p>
                <br><br>
            <table id="myTable1" class= "table" style=" border: 2px solid black;">
                    <tr>
                        <td>ID</td>
                        <td>Patient first name</td>
                        <td>Patient last name</td>
                        <td>Patient Date of Birth</td>
                        <td>Patient Age</td>
                        <td>Patient Address</td>
                        <td>Patient Phone Number</td>
                        <td>Patient Email</td>
                        <td>Patient Blood Type</td>
                        <td>Patient Medical History</td>
                        <td>Patient Illness</td>
                        <td>Patient Allergies</td>
                        <td>Patient Perscription</td>                       
                    </tr>
            <?php
               while($row = $result->fetchObject()) {
                   echo "<tr>";
                       echo "<td>$row->PatientID</td>";
                       echo "<td>$row->firstName</td>";
                       echo "<td>$row->lastName</td>";
                       echo "<td>$row->dateOfBirth</td>";                       
                       echo "<td>$row->age</td>";                       
                       echo "<td>$row->userAddress</td>";                       
                       echo "<td>$row->phoneNumber</td>";                       
                       echo "<td>$row->email</td>";                       
                       echo "<td>$row->bloodType</td>";                       
                       echo "<td>$row->medicalHistory</td>";                       
                       echo "<td>$row->illness</td>";                       
                       echo "<td>$row->allergies</td>";                       
                       echo "<td>$row->prescription</td>";                       
                   echo "</tr>";    
                   
                   $name = $row->firstName;
               }
            ?>
            </table>
            </br>
            <input type="text" class="search"  onkeyup="myFunction()" placeholder="Find Data">
            <table id="myTable" class= "table" style=" border: 2px solid black;">
                    <tr>
                        <td>Date</td>
                        <td>Hours of Sleep</td>
                        <td>Hours of Exercise</td>
                        <td>Heart Rate</td>
                        <td>Exercise Done</td>                                               
                    </tr>
            <?php
               while($row = $result1->fetchObject()) {
                   echo "<tr>";
                       echo "<td>$row->dateOfExercise</td>";
                       echo "<td>$row->hoursOfSleep</td>";
                       echo "<td>$row->hoursOfExercise</td>";
                       echo "<td>$row->heartRate</td>";
                       echo "<td>$row->exerciseDone</td>";
                       echo "<td><form method='GET' name='form' action='./editDataForm.php'>
                       <input type='hidden' value='$row->HealthDataID' name='hid'>
                       <input type='hidden' value='$row->userID' name='pid'>
                       <input type='submit' value='Edit' id='btnSelect' onClick='selected($row->userID)'>
                       </form>
                       </td>";
                       echo "<td><form method='GET' name='form' action='./deleteDataView.php'>
                       <input type='hidden' value='$row->HealthDataID' name='hid'>
                       <input type='hidden' value='$row->userID' name='pid'>
                       <input type='submit' value='Delete' id='btnSelect' onClick='selected($row->userID)'>
                       </form>
                       </td>";
                   echo "</tr>";
                 }
            ?>
            </table>
    </div>
</div>
    <div class="col-sm-2 sidenav">
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
    <p>Created by: Gustavo Sanchez, Arjun Grewal, Kenneth Alegria, Luke Midgley and Greg Smith</p>
    <p>Made with PHP, Bootstrap, JS and MySQL</p>
            <p>Contact information: <a href="mailto:gsanchezcollado@gmail.com">
              gsanchezcollado@gmail.com</a></p>
</footer>
</body>
</html>
