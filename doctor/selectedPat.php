<?php 
// #includes
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

$_SESSION['chat_pID'] = $_GET["pid"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="./homeDoc.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
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
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Register new patient</button>
    <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register new Doctor</button>
    <br><br>
    <!-- Button for chat, displays the name of the patient -->
    <button onclick="window.location.href = '../chat/chat.php';"style="width:auto; background-color: #00acee;"> Chat with
    <?php while($row = $result->fetchObject()) {echo "$row->firstName";}?>
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
                       echo "<td><form method='GET' name='form' action='editDataForm.php'>
                       <input type='hidden' value='$row->HealthDataID' name='hid'>
                       <input type='hidden' value='$row->userID' name='pid'>
                       <input type='submit' value='Edit' id='btnSelect' onClick='selected($row->PatientID)'>
                       </form>
                       </td>";
                       echo "<td><form method='GET' name='form' action='deleteDataView.php'>
                       <input type='hidden' value='$row->HealthDataID' name='hid'>
                       <input type='hidden' value='$row->UserID' name='pid'>
                       <input type='submit' value='Delete' id='btnSelect' onClick='selected($row->PatientID)'>
                       </form>
                       </td>";
                   echo "</tr>";
                 }
            ?>
            </table>
    </div>
</div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>
<div id="id01" class="modal">

</div>

<!-- Patient sign up -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form  action="insertPat.php"  method="post">
    <div class="container">
      <h1>Patient Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="firstName"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="firstname" required>

      <label for="lastName"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="lastname" required>

      <label for="age"><b>Age</b></label>
      <input type="text" placeholder="Enter Age" name="age" required>

      <label for="address"><b>Adress</b></label>
      <input type="text" placeholder="Enter Address" name="address" required>

      <label for="phone"><b>Phone Number</b></label>
      <input type="text" placeholder="Enter Phone Number" name="num" required>

      <label for="blood"><b>Blood type</b></label>
      <input type="text" placeholder="Enter BT" name="bood" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="docID"><b>Doctor ID</b></label>
      <input type="text" placeholder="Enter ID" name="docID" required>

      <label for="password"><b>Password</b></label>
      <input type="text" placeholder="Enter Password" name="password" required>

      <label for="dateOfBirth"><b>Date of Birth</b></label>
      <input type="date" placeholder="Enter Name" name="dob" required>
      
      <!-- <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label> -->

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit"  class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>
<!-- Doc sign up -->
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form  action="insertDoc.php"  method="post">
    <div class="container">
      <h1>Doctor Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="name" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="password"><b>Password</b></label>
      <input type="text" placeholder="Enter Password" name="password" required>
      

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit"  class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>



<script>
// Get the modal
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
}
    
function selected(pid){
   <?php $_SESSION['PatientID'] = $_GET['pid']; ?>
   window.location.href = "./editDataForm.php";
}
</script>

<footer class="container-fluid text-center">
    <p>Created by: Gustavo Sanchez, Arjun Grewal, Kenneth Alegria, Luke Midgley and Gregg Smith</p>
    <p>Made with PHP, Bootstrap, JS and MySQL</p>
            <p>Contact information: <a href="mailto:gsanchezcollado@gmail.com">
              gsanchezcollado@gmail.com</a></p>
</footer>
</body>
</html>
