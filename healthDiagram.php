<?php
  require('includes/conn.inc.php');
  require('includes/functions.inc.php');

  $sType = safeString($_GET['type']); //Changes depending on what you click
  $user_id = "1";                     //NEEDS to change depending on the logged in user

  if ($sType != "exercise_done"){
    $sql = "SELECT $sType, date FROM healthData WHERE userID = $user_id";
  } else {
    $sql = "SELECT $sType, date, hoursOfExercise FROM healthData WHERE userID = $user_id";
  }
  $stmt = $pdo->query($sql);

  $dataP = array();
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
    <div style="text-align:center" id="container">
        <h1>Hello world</h1>
        <select id="select">
        <option value="line">line</option>
        <option value="bar">bar</option>
        <option value="pie">pie</option>
        <option value="scatter">scatter</option>
        </select>
        <br>

        <!-- PHP for displaying the raw data -->
        <?php 
        if($sType == "heartRate"){
          $i = 99;
				  while($row =$stmt->fetchObject()){
            echo "<p> Exercise Name: <b> $row->heartRate </b> --
                      Date: <b> $row->date </b></p>"; 
            //THIS SHOULD BE WORKING : "x"=>$row->date_stored,

            //array_push($dataP, array( "x"=>$i, "y"=>$row->heart_rate));
            array_push($dataP, array("y"=>$row->heartRate, "x"=>$i));
            $i++;
          }
        } elseif ($sType == "hoursOfSleep") {
          while($row =$stmt->fetchObject()){
            // echo "<p> Exercise Name: <b> $row->hours_slept </b> --
            //           Date: <b> $row->date_stored </b></p>"; 
            
            array_push($dataP, array( "y"=>$row->hoursOfSleep));
          }
        } elseif ($sType == "exerciseDone") {
            while($row =$stmt->fetchObject()){
              // echo "<p> Exercise Name: <b> $row->exercise_done </b> --
              //           Time: <b> $row->exercise_time </b></p>"; 

              array_push($dataP, array("x"=> $row->exerciseDone, "y"=>$row->hoursOfExercise));
            }
        }?>

<script> 
window.onload = function () {
  var graphType = "line"
  loadGraph(graphType);
}

window.onchange = function () {
  $("#select" ).on('change', function() { 
    loadGraph( $(this).val() );
  });
}

function loadGraph(graphType) {
console.log("type: ", graphType);
var titleMsg = "<?php echo $sType; ?>";
var data2 = <?php echo json_encode($dataP, JSON_NUMERIC_CHECK); ?>;


var dps = [];
//Insert Array Assignment function here
for(var i=0; i<data2.length;i++) {
    dps.push({"x":data2[i].x, "y":data2[i].y});
}

console.log(dps)

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: titleMsg
	},
  axisX:{
    title: "YYYY MM DD",
  },
	data: [{        
		type: graphType,
    xValueType: "YYYY-MM-DD",
    indexLabelFontSize: 16,
    
		dataPoints: dps
	}]
});
chart.render();
}
</script>

<div id="chartContainer" style="height: 370px; width: 60%; padding-left: 20%"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

</div>
</body>

<footer class="container-fluid text-center">
    <p>Created by: Gustavo Sanchez, Arjun Grewal, Kenneth Alegria, Luke Midgley and Gregg Smith</p>
    <p>Made with PHP, Bootstrap, JS and MySQL</p>
            <p>Contact information: <a href="mailto:gsanchezcollado@gmail.com">
              gsanchezcollado@gmail.com</a></p>
</footer>
</html>