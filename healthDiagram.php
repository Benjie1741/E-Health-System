<?php
  require('includes/conn.inc.php');

  $type = "heart_rate"; //NEEDS TO CHANGE DEPENDING ON WHAT YOU CLICK
  $user_id = "1";       //CHANGES DEPENDING ON USER LOGGED IN

  $sql = "SELECT $type FROM healthData WHERE user_id = $user_id";
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
          <li class="active"><a href="/E-Health-System/healthDiagram.php">TEMP</a></li>
          <li><a href="#">Projects</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
</head>

<!-- Main body -->
<body>
    <div id="container">
        <h1 style="text-align:center">Hello world</h1>

        <?php
				while($row =$stmt->fetchObject()){
          // echo "<p>$row->id</p>";
          // echo "<p>$row->user_id</p>";
          // echo "<p>$row->doctor_id</p>";
          echo "<p>$row->heart_rate</p>";
          // echo "<p>$row->hours_slept</p>";
          // echo "<p>$row->exercise_done</p>";
          // echo "<p>$row->exercise_time</p>";
          // echo "<p>$row->date</p>";
        }
        ?>
        
    </div>
   

</body>

<footer style="padding-top:3%" class="container-fluid text-center">
    <br> <br>
    <p>Copyright &copy; 2020</p>
    <p>Footer Text</p>
</footer>

</html>