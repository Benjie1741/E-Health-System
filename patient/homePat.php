<?php 
//Includes
require('../includes/conn.inc.php');
require('../includes/functions.inc.php');
require('../includes/checkLoggedIn.php');    

echo '<script>';
echo 'console.log('. json_encode( $_SESSION ) .')';
echo '</script>';

ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Health Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
      margin-top: 100px;
    }
    </style>
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
	<li><a href="./uploadData.php">Upload</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
</head>
<!-- Main body -->
<body>
    <div id="container">
        <h1 style="text-align:center">Hello <?php echo $_SESSION['username']?></h1>
        <!-- Link diagrams -->
        <div style="text-align:center; padding-top:5%" class="imgGrid">
            <div class="grid">
                <a href="./healthDiagram.php?type=heartRate">
                <img src="../img/heart-icon.png" alt="heart Icon" style="padding-right: 20px; margin-bottom: 10px;">
                </a>

                <a href="./healthDiagram.php?type=hoursOfExercise">
                <img src="../img/exercise-icon.png" alt="exercise Icon" style="padding-right: 20px; margin-bottom: 10px;">
                </a>

                <a href="./healthDiagram.php?type=hoursOfSleep">
                <img src="../img/sleep-icon.png" alt="Sleep Icon" style="padding-right: 20px; margin-bottom: 10px;">
                </a>

                <a href="../chat/chat.php">
                <img src="../img/chat-icon.png" alt="chat Icon" style="padding-right: 20px; margin-bottom: 10px;">
                </a>

                <a href="./info.php">
                <img src="../img/info-icon.png" alt="info Icon" style="padding-right: 20px; margin-bottom: 10px;">
                </a>
            </div>
		</div>
    </div>
</body>

<footer style="padding-top:3%" class="container-fluid text-center">
    <br> <br>
    <p>Copyright &copy; 2020</p>
    <p>Footer Text</p>
</footer>

</html>


<script>
//AUTO DATA UPLOAD
    //Calls chat fucntion every second
    setInterval(function(){
        insertData();
    }, 60000); //Uploads data every minute, can be cahnged if needed

    function insertData() {
    
    var randHeartRate = Math.floor((Math.random() * 120-70) +70);
    var randHoursOfExercise = Math.floor((Math.random() * 4));
    var randHoursOfSleep = Math.floor((Math.random() * 10 - 5) + 5);
    var exerciseDone = rngExercise();
    
    var data = "heartRate="+randHeartRate+
                "&hoursOfExercise="+randHoursOfExercise+
                "&hoursOfSleep="+randHoursOfSleep+
                "&exerciseDone="+exerciseDone;

    var message = $('.textarea').val();
    $.post('./autoData.php?'+data, function(response){
    });  
    console.log("Random Data Added: " + data);
  }

  function rngExercise(){
    var rngE = Math.floor((Math.random() *4 ));
    var exercise = "";

    switch(rngE){
      case 0:
        exercise = "Badminton";
        break;
      case 1:
        exercise = "Tennis";
        break;
      case 2:
        exercise = "Gym";
        break;
      case 3:
        exercise = "Running";
        break;
      case 4:
        exercise = "Swimming";
        break;
    }
    return exercise;
  }

</script>