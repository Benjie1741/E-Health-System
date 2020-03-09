<!DOCTYPE html>
<html lang="en">

<head>
  <title>Health Dashboard</title>
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
          <li class="active"><a href="/E-Health-System/home.php">Home</a></li>
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

        <!-- Link diagrams -->
        <div style="text-align:center; padding-top:5%" class="imgGrid">
            <div class="grid">
                
                <a href="/E-Health-System/healthDiagram.php?type=heartRate">
                <img src="./img/heart-icon.png" alt="heart Icon">
                </a>

                <a href="/E-Health-System/healthDiagram.php?type=hoursOfExercise">
                <img src="./img/exercise-icon.png" alt="exercise Icon">
                </a>

                <a href="/E-Health-System/healthDiagram.php?type=hoursOfSleep">
                <img src="./img/sleep-icon.png" alt="heart Icon">
                </a>

                <img src="./img/chat-icon.png" alt="chat Icon">
                <img src="./img/info-icon.png" alt="info Icon">
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