<?php 
// #includes
require('includes/conn.inc.php');


  session_start();
  $found=false;
  if($_SESSION["login"]==1){
    $found=true;
  }
  if($found==false){
    header("Location: ../eHealth/login.php");
  }

if (isset($_GET['search'])){
  $searchTerm = "%" . $_GET['search'] . "%";
  $sql= "SELECT * FROM items
        WHERE (name LIKE :search OR price LIKE :search)"; /* could add genre */
  $stmt2 = $pdo->prepare($sql);
  $stmt2->bindParam(':search', $searchTerm, PDO::PARAM_STR);
  $stmt2->execute();
}


ini_set('display_errors', 1);

//to display all the images
$sql = "SELECT * FROM items";
$stmt = $pdo->query($sql);
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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
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
                
                <a href="healthDiagram.php?type=heartRate">
                <img src="./img/heart-icon.png" alt="heart Icon">
                </a>
                <a href="healthDiagram.php?type=exerciseDone">
                <img src="./img/exercise-icon.png" alt="exercise Icon">
                </a>
                <a href="healthDiagram.php?type=hoursOfSleep">
                <img src="./img/sleep-icon.png" alt="heart Icon">
                </a>
                <img src="./img/chat-icon.png" alt="chat Icon">
                <img src="./img/info-icon.png" alt="info Icon">
            </div>
		</div>
    </div>
   
</body>
<footer class="container-fluid text-center">
    <p>Created by: Gustavo Sanchez, Arjun Grewal, Kenneth Alegria, Luke Midgley and Gregg Smith</p>
    <p>Made with PHP, Bootstrap, JS and MySQL</p>
            <p>Contact information: <a href="mailto:gsanchezcollado@gmail.com">
              gsanchezcollado@gmail.com</a></p>
</footer>
</html>