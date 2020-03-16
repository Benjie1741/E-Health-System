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
$sql = "SELECT * FROM `patients` where `PatientID` = " . $patientID;
$result = $pdo->query($sql);
$row = $result->fetchObject();
echo '<script>console.log('. json_encode($patientID). ')</script>';
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
  <form  action="../backend/editPatientData.php"  method="post">
    <div class="container" style="color: black">
      <h1>Edit patient health data</h1>
      <p>Please edit this form to update health data</p>
      <hr>
      <input type='hidden' value='<?php echo $patientID; ?>' name='pid'>

      <label for="address"><b>Address: </b></label>
      <input style="color: black" type="text" value="<?php print $row->userAddress ?>" name="address" required>

      <label for="phoneNumber"><b>Phone Number: </b></label>
      <input style="color: black" type="text" value="<?php print $row->phoneNumber?>" name="num" required pattern="^(\+\s?7\d{1}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$">

      <label for="email"><b>Email:</b></label>
      <input style="color: black" type="text" value="<?php print $row->email?>" name="email" required>

      <label for="medicalHistory"><b>Medical History: </b></label>
      <input style="color: black" type="text" value="<?php print $row->medicalHistory?>" name="medicalHistory" required>

      <label for="illness"><b>Illness: </b></label>
      <input style="color: black" type="text" value="<?php print $row->illness?>" name="illness" required>

      <label for="allergies"><b>Allergies: </b></label>
      <input style="color: black" type="text" value="<?php print $row->allergies?>" name="allergies" required>

      <label for="prescription"><b>Prescription: </b></label>
      <input style="color: black" type="text" value="<?php print $row->prescription?>" name="prescription" required>

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
