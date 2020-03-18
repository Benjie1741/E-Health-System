<?php 
//Description: Info page that tells the user how to operate the program.

require('../includes/conn.inc.php');
require('../includes/checkLoggedIn.php');    
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
      <a class="navbar-brand" href="./homePat.php">E-Health</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
        <li><a href="./homePat.php">Home</a></li>
	      <li><a href="./uploadData.php">Upload Health Data</a></li>
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
    <h1 >Instructions: </h1>
        

        <p > 
          To input your own health data, please click on Upload Health Data.
          <br><br>
          To display heart rate data, click on the heart icon.
          <br>
          To display exercise data, click on the sport shoe icon.
          <br>
          To display sleep data, click on the thinking bubble that shows 'Z z' in the image.
          <br><br>
          To open the chat, click on the speech boxes with a '?' in the image.
          <br><br>
          To go back to the home page, click'Home' on the navigation bar on the top of the page.
          <br><br>
        To log out, click on the logout icon on the top right corner.
        <br>

        </p>

    </div>
<footer class="container-fluid text-center">
  <p>Created by: Gustavo Sanchez, Arjun Grewal, Kenneth Alegria, Luke Midgley and Greg Smith</p>
  <p>Made with PHP, Bootstrap, JS and MySQL</p>
  <p>Contact information: <a href="mailto:gsanchezcollado@gmail.com">
  gsanchezcollado@gmail.com</a></p>
</footer>
</body>
</html>