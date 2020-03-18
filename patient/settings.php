<?php 
// #includes
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
  <title>Settings</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/themes.css">
  <link rel="stylesheet" href="../css/doc.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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

<body>
<div id="container">
<div style="text-align:center; padding-top:1%" class="imgGrid">
<h2>Settings - Individual Enhancement</h2>

    <form action="../backend/updateSettings.php"  method="post" style="padding-top: 30px;">

      <label for="theme"><b>Theme</b></label><br>
       <select name="Theme">
       <option>Light-Mode</option>
       <option>Dark-Mode</option>
       <option>Colour-assist</option>
       </select>
       <br><br>

       <label for="size"><b>Text Size</b></label><br>
       <select onchange="changeSize(this);" name="Text">
       <option>xx-small</option>
       <option>x-small</option>
       <option>small</option>
       <option>medium</option>
       <option>large</option>
       <option>x-large</option>
       <option>xx-large</option>
       <option>250%</option>
       <option>2cm</option>
       <option>100px</option>
       </select>
       <br><br>

       <label for="Font"><b>Font Family (will change title and body text)</b></label><br>
       <select onchange="changeFont(this);" name="Font">
       <option>Helvetica, Arial, sans-serif</option>
       <option>Impact,Charcoal,sans-serif</option>
       <option>Times, "Times New Roman", serif</option>
       <option>cursive</option>
       </select>
       <br><br><br><br>

       <button type="submit" id="insert">Save Settings</button>
       
    </form>
    <button onclick="go()">Change Password</button> <br> <br> <br>
    <label for="theme"><b>Toggle Theme</b></label> <br>
    <button onclick="loadDark();"> Dark Theme </button>
    <button onclick="loadLight();"> Light Theme </button>
    <button onclick="loadCB();"> Colour-assist </button> <br>
      <div class="grid">
        <div id=1>
          <p>This is example text.</p>
        </div>
        <div id=2>
          <p>This is example text.</p>
        </div>
        <div id=3>
          <p>This is example text.</p>
        </div>
      </div>
  </div>
</div>

</body>
<footer class="container-fluid text-center">
    <p>Created by: Gustavo Sanchez, Arjun Grewal, Kenneth Alegria, Luke Midgley and Greg Smith</p>
    <p>Made with PHP, Bootstrap, JS and MySQL</p>
    <p>Contact information: <a href="mailto:gsanchezcollado@gmail.com">
        gsanchezcollado@gmail.com</a></p>
</footer>
</html>

<script>
  window.onload = function(){
    var t = "<?php echo $_SESSION['theme']; ?>";
    var f = "<?php echo $_SESSION['font']; ?>";
    var s = "<?php echo $_SESSION['textSize']; ?>";

    console.log(t + f + s);
    document.body.classList.toggle(t);
    document.body.style.fontFamily = f;
    document.body.style.fontSize = s;
  }

    function loadDark(){
      document.getElementById('1').classList.toggle("Dark-Mode");
    }
    function loadLight(){
      document.getElementById('2').classList.toggle("Light-Mode");
    }
    function loadCB(){
      document.getElementById('3').classList.toggle("Colour-assist");
    }

    function changeSize(selectTag) {
      var listValue = selectTag.options[selectTag.selectedIndex].text;
      for (let i=1; i<=3; i++) {
        document.getElementById(i).style.fontSize = listValue;
      }
      
    }
    function changeFont(selectTag) {
      var listValue = selectTag.options[selectTag.selectedIndex].text;
      for (let i=1; i<=3; i++) {
        document.getElementById(i).style.fontFamily = listValue;
      }
    }

   function go(){
    window.location.href = "./changePassword.php";
  }

</script>
