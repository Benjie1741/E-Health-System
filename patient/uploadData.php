<?php 
require('../includes/conn.inc.php');
require('../includes/functions.inc.php');
require('../includes/checkLoggedIn.php');

ini_set('display_errors', 1);

//to display all the images
$sql =  "SELECT `PatientID`, `age`, `firstName`, `lastName`, `doctorID` FROM `patients`";
$result = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload Health Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/themes.css">
  <link rel = "stylesheet" href = "../css/form.css"/>

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
	      <li class="active"><a href="./uploadData.php">Upload Health Data</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="id01" class="">
  <form  action="../backend/insertHealthData.php"  method="post">
    <div class="container" >
      <h1>Upload data</h1>
      <p>Please fill in this form to upload health data</p>
      <hr>
      <label for="hoursOfSleep"><b>Hours of sleep: </b></label>
      <input style="color: black" type="number" placeholder="eg 7" name="hoursOfSleep" required min="4" max="14">

      <label for="hoursOfExercise"><b>Hours of exercise: </b></label>
      <input style="color: black" type="number" placeholder="eg 2" name="hoursOfExercise" required min="0" max="5">

      <label for="heartRate"><b>Average daily heart rate (BPM):</b></label>
      <input style="color: black" type="number" placeholder="eg 73" name="heartRate" required min="50" max="140">

      <label for="exerciseDone"><b>Exercise Done: </b></label>
      <input style="color: black" type="text" placeholder="eg Running, Yoga, etc." name="exerciseDone" required pattern="[A-Za-z]{1,15}">
      
      <?php $date = date("Y/m/d");?>
      <label for="dateOfExercise"><b>Date of exercise: </b></label>
      <input style="color: black" type="date" name="doe" required id="dob" max="<?php $date;?>" min="01/01/1900">

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
        <button type="submit"  class="signupbtn">Upload</button>
      </div>
    </div>
  </form>
</div>
<script>
  //Function for themes
  window.onload = function(){
    var t = "<?php echo $_SESSION['theme']; ?>";
    var f = "<?php echo $_SESSION['font']; ?>";
    var s = "<?php echo $_SESSION['textSize']; ?>";

    console.log(t + f + s);
    document.body.classList.toggle(t);
    document.body.style.fontFamily = f;
    document.body.style.fontSize = s;
  }

  function leave(){
   window.location.href = "./homePat.php";
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
