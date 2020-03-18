<?php 
//Desciption: Checks to see if you are sure you want to delete a patient record.
//Called by: homeDoc.php Line 107.
//Calls: /backend/deletePat.php.

require('../includes/conn.inc.php');
require('../includes/functions.inc.php');
require('../includes/checkLoggedIn.php'); 

   echo '<script>';
   echo 'console.log('. json_encode( $_SESSION ) .')';
   echo '</script>';

ini_set('display_errors', 1);
$pid = $_GET['pid'];
//to display all the images
$sql =  "SELECT `PatientID`, `age`, `firstName`, `lastName`, `doctorID` FROM `patients` WHERE `PatientID` =" . $pid;
$result = $pdo->query($sql);
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
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="/eHealth/chat.php">Chat</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="id01" class="">
  <form  action="../backend/deletePat.php"  method="post">
    <div class="container">
      <h1>Delete patient?</h1>
      <p>Are you sure you want to delete this patient?</p>
      <?php
        #get healthdataID from url variable
        $_SESSION['PatientID'] = $_GET['pid'];
      ?>
      <hr>
      <table id="myTable" class= "table" style=" border: 2px solid black;">
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Patient first name</b></td>
                        <td><b>Patient last name</b></td>
                        <td><b>Patient Age</b></td>
                    </tr>
            <?php
               while($row = $result->fetchObject()) {
                 if($row->doctorID === $_SESSION['DoctorID']){
                   echo "<tr>";
                       echo "<td>$row->PatientID</td>";
                       echo "<td>$row->firstName</td>";
                       echo "<td>$row->lastName</td>";
                       echo "<td>$row->age</td>";
                   echo "</tr>";
                 }
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
    
function leave()
{
  window.location.href = "./homeDoc.php";
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
