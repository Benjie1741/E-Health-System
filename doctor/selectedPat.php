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
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }

/* modal */
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  /* width: 100%; this breaks navbar in mobile view*/
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
  </style>
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
