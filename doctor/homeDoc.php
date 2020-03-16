<?php 
require('../includes/conn.inc.php');
require('../includes/functions.inc.php');
require('../includes/checkLoggedIn.php'); 

  echo '<script>';
  echo 'console.log('. json_encode( $_SESSION ) .')';
  echo '</script>';

ini_set('display_errors', 1);

//to display all the patients
$sql =  "SELECT `PatientID`, `age`, `firstName`, `lastName`, `doctorID`, (SELECT COUNT(*) FROM chatmessages c where c.pID = PatientID and c.seen = 0) notification FROM `patients`p";
$result = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doctor Home</title>
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
    <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register new Doctor</button>
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Register new patient</button>
    </div>
    <div class="col-sm-8 text-left"> 
    <div id="patientList" class="bg-1">
              
                <h3 class="text-center">Patient List</h3>
                <p class="text-center">In this section you can find a list of your patients!</p>
                <input type="text" class="search"  onkeyup="myFunction()" placeholder="Find Patients">
                <br><br>
            <table id="myTable" class= "table" style=" border: 2px solid black;">
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Patient first name</b></td>
                        <td><b>Patient last name</b></td>
                        <td><b>Patient Age</b></td>
                        <td><b>View Info</b></td>
                        <td><b>Delete</b></td>
                        <td></td>
                    </tr>
            <?php
               while($row = $result->fetchObject()) {
                 if($row->doctorID === $_SESSION['DoctorID']){
                   echo "<tr>";
                       echo "<td>$row->PatientID</td>";
                       echo "<td>$row->firstName</td>";
                       echo "<td>$row->lastName</td>";
                       echo "<td>$row->age</td>";
                       //Selected Patient Button
                       echo "<td><form method='GET' name='form' action='./selectedPat.php'>
                                    <input type='hidden' value='$row->PatientID' name='pid'>
                                    <input type='submit' value='SELECT' id='btnSelect' onClick='selected($row->PatientID)'>
                                 </form>
                             </td>";
                      //Delete Patient Button
                      echo "<td>
                         <form method='GET' name='form' action='../backend/deletePat.php'>
                         <input type='hidden' value='$row->PatientID' name='pid'>
                         <input type='submit' value='Delete' id='btnDel' onClick='selected($row->PatientID)'>
                         </form>
                        </td>";
                        if($row->notification > 0){
                          echo "<td>MESSAGE NOTIFICATION</td>";
                        }     
                        else {
                          echo "<td></td>";
                        }                  
                   echo "</tr>";
                 }
               }
            ?>
            </table>
    </div>
</div>

    <div class="col-sm-2 sidenav">

    </div>
  </div>
</div>

<!-- patient sign up -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form  action="../backend/insertPat.php"  method="post">
    <div class="container">
      <h1>Patient Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="firstName"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="firstname" required pattern="[A-Za-z]{2,30}">

      <label for="lastName"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="lastname" required pattern="[A-Za-z]{2,30}">

      <label for="age"><b>Age</b></label>
      <input type="number" placeholder="Enter Age" name="age" required min="0">

      <label for="address"><b>Address</b></label>
      <input type="text" placeholder="Enter Address" name="address" required>

      <label for="phone"><b>Phone Number</b></label>
      <input type="text" placeholder="Enter Phone Number" name="num" required 
      pattern="^(\+\s?7\d{1}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$">

      <label for="blood"><b>Blood type</b></label>
      <input type="text" placeholder="Enter BT" name="blood" required list="l1">
      <datalist id="l1">
        <option>O+</option>
        <option>O-</option>
        <option>A+</option>
        <option>A-</option>
        <option>B+</option>
        <option>B-</option>
        <option>AB+</option>
        <option>AB-</option>
      </datalist>

      <label for="history"><b>Medical History</b></label>
      <input type="text" placeholder="Enter Medical History" name="history" required>

      <label for="illness"><b>Illness</b></label>
      <input type="text" placeholder="Enter Illness" name="illness" required>

      <label for="allergies"><b>Allergies</b></label>
      <input type="text" placeholder="Enter Allergies" name="allergies" required>

      <label for="prescription"><b>Prescription</b></label>
      <input type="text" placeholder="Enter Perscription" name="prescription" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required pattern="\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\b">

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <?php $date = date("Y/m/d");?>
      <label for="dateOfBirth"><b>Date of Birth</b></label>
      <input type="date" placeholder="Enter Name" name="dob" required id="dob" max="<?php $date;?>" min="01/01/1900">

      <script>
      $(function(){
          var dtToday = new Date();
          
          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();
          if(month < 10)
              month = '0' + month.toString();
          if(day < 10)
              day = '0' + day.toString();
          
          var maxDate = year + '-' + month + '-' + day;
          $('#dob').attr('max', maxDate);
      });
      </script>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" id="insert" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<!-- Doctor sign up -->
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form  action="../backend/insertDoc.php"  method="post">
    <div class="container">
      <h1>Doctor Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="firstName"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="firstname" required pattern="[A-Za-z]{2,30}">

      <label for="lastName"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="lastname" required pattern="[A-Za-z]{2,30}">

      <label for="age"><b>Age</b></label>
      <input type="number" placeholder="Enter Age" name="age" required min="0">

      <label for="address"><b>Address</b></label>
      <input type="text" placeholder="Enter Address" name="address" required>

      <label for="phone"><b>Phone Number</b></label>
      <input type="number" placeholder="Enter Phone Number" name="num" required>

      <label for="specialty"><b>Specialty</b></label>
      <input type="text" placeholder="Enter Specialty" name="specialty" list="l2" required>
      <datalist id="l2">
        <option>Pediatrician</option>
        <option>Gynecologist</option>
        <option>Surgeon</option>
        <option>Psychiatrist</option>
        <option>Cardiologist</option>
        <option>Dermatologist</option>
        <option>Oncologist</option>
        <option>Neurologist</option>
      </datalist>

      <label for="clearance"><b>Clearance level</b></label>
      <input type="number" placeholder="Enter Clearance level" name="clearance" required list="l3">
      <datalist id="l3">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </datalist>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required pattern="\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\b">

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <label for="dateOfBirth"><b>Date of Birth</b></label>
      <input type="date" placeholder="Enter Name" name="dob" required>

      <label for="license"><b>License Revalidation Date</b></label>
      
      <?php $date = date("Y/m/d");?>
      <label for="dateOfBirth"><b>Date of Birth</b></label>
      <input type="date" placeholder="Enter Name" name="dob" required id="dobDoc" max="<?php $date;?>" min="01/01/1900">

      <label for="license"><b>License Revalidation Date</b></label>
      <input type="date" placeholder="Enter License Revalidation Date" name="license" id="LRDDoc" max="<?php $date;?>" min="01/01/1900"required>
      
      <script>
      $(function(){
          var dtToday = new Date();
          
          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();
          if(month < 10)
              month = '0' + month.toString();
          if(day < 10)
              day = '0' + day.toString();
          
          var maxDate = year + '-' + month + '-' + day;
          $('#dobDoc').attr('max', maxDate);
      });
      </script>

      <script>
      $(function(){
          var dtToday = new Date();
          
          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();
          if(month < 10)
              month = '0' + month.toString();
          if(day < 10)
              day = '0' + day.toString();
          
          var maxDate = year + '-' + month + '-' + day;
          $('#LRDDoc').attr('max', maxDate);
      });
      </script> 

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
   window.location.href = "./selectedPat.php";
}

$(document).ready(function() {
  $('#insert').click(function(){
    var image_name = $('image').val();
    if(image_name == '')
    {
      alert("Please Select Image");
      return false;
    }
    else 
    {
      var extension = $('#image').val().split('.').pop().toLowerCase();
      if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
      {
        alert('Invalid Image File');
        $('image').val('');
        return false;
      }
    }
  });
});

</script>

<footer class="container-fluid text-center">
    <p>Created by: Gustavo Sanchez, Arjun Grewal, Kenneth Alegria, Luke Midgley and Greg Smith</p>
    <p>Made with PHP, Bootstrap, JS and MySQL</p>
            <p>Contact information: <a href="mailto:gsanchezcollado@gmail.com">
              gsanchezcollado@gmail.com</a></p>
</footer>

</body>
</html>
