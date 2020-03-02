<?php
  require('includes/conn.inc.php');
  require('includes/functions.inc.php');

  $sType = safeString($_GET['type']); //Changes depending on what you click
  $user_id = "1";                     //NEEDS to change depending on the logged in user

  if ($sType != "exercise_done"){
    $sql = "SELECT $sType FROM healthData WHERE user_id = $user_id";
  } else {
    $sql = "SELECT $sType, exercise_time FROM healthData WHERE user_id = $user_id";
  }
  $stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ARJ - Health Diagram</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <!-- Mobile navbar -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Logo</a>
      </div>
      <!-- Desktop navbar -->
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="/E-Health-System/index.html">Index</a></li>
          <li><a href="/E-Health-System/home.php">Home</a></li>
          <li><a href="#">Projects</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
</head>

<!-- Main body -->
<body>
    <div style="text-align:center" id="container">
        <h1>Hello world</h1>
        <br>

        <!-- PHP for displaying the raw data -->
        <?php 
        if($sType == "heart_rate"){
				  while($row =$stmt->fetchObject()){
            echo "<p> Heart Rate: <b> $row->heart_rate </b></p>"; 
          }
        } elseif ($sType == "hours_slept") {
          while($row =$stmt->fetchObject()){
            echo "<p> Hours Slept: <b> $row->hours_slept </b></p>"; 
          }
        } elseif ($sType == "exercise_done") {
            while($row =$stmt->fetchObject()){
              echo "<p> Exercise Name: <b> $row->exercise_done </b> --
                        Time: <b> $row->exercise_time </b></p>"; 
            }
        }?>
    
  </div>
</body>

<footer style="padding-top:3%" class="container-fluid text-center">
    <br>
    <p>Copyright &copy; 2020</p>
    <p>Footer Text</p>
</footer>

</html>