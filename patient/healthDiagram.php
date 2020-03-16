<?php
  require('../includes/conn.inc.php');
  require('../includes/functions.inc.php');
  require('../includes/checkLoggedIn.php'); 

  echo '<script>';
  echo 'console.log('. json_encode( $_SESSION ) .')';
  echo '</script>';

  //Sets the health parameter, the user id, and the type of graph
  $sType = safeString($_GET['type']);
  $user_id = $_SESSION["patientId"];
  $cType = null;

  //Gets the data
  $sql = "SELECT $sType, dateOfExercise FROM healthData WHERE userID = $user_id";
  $stmt = $pdo->query($sql);

  //Changes the type of graph to display
  if($sType == "heartRate") {
    $cType = "line";
  }elseif ($sType == "hoursOfSleep") {
    $cType = "pie";
  }else{
    $cType = "bar";
  }

  //Arrays for data
  $dataPoints = array();
  $datePoints = array();
?>

<!DOCTYPE html>
<html ng-app="GraphData">

<head>
  <title>Health Diagram</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/doc.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.3/angular.js"></script>
  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="chart.js"></script>

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
    <div style="text-align:center" id="container">
        <h1><?php echo $sType?> Data</h1>
        <br>
        <!-- PHP for storing the data from the db into an array, only stores the latest 7 values by date -->
        <?php 
        $i = 0;
				  while($row =$stmt->fetchObject()){
            if ($i < 7 ) {
            $dataPoints[] = $row->$sType;
            $datePoints[] = $row->dateOfExercise;
            $i++;
            }
          }
        ?>

  <!-- Graph data -->
  <script>
        function MainCtrl($scope, $http){
          var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
          var dateT = <?php echo json_encode($datePoints); ?>;
          console.log(dataPoints)
          console.log(dateT)

          //Weekly data
            var data = {
              "xData": [ dateT[0], dateT[1], dateT[2],  dateT[3],  dateT[4],  dateT[5],  dateT[6]],              
              "yData":[{ "data": dataPoints }]
            }      
            $scope.lineChartYData=data.yData
            $scope.lineChartXData=data.xData
        }
    </script>

    <!-- Displaying the graph -->
    <script>
    window.onload = function () {
      var graphType =  "<?php echo $cType; ?>";
      loadGraph(graphType);
    }

    window.onchange = function () {
      $("#select" ).on('change', function() {
        console.log("onchange")
        loadGraph( $(this).val() );
      });
    }

    function loadGraph(graphType) {

    var title =  "<?php echo $sType; ?>";
    var type = graphType

    angular.module('GraphData',['AngularChart'], function( $routeProvider, $locationProvider ){
      $routeProvider.when('/',{
          template: '<chart title='+title+' type='+type+' xData="lineChartXData" yData="lineChartYData" xName="Date" yName="Values"></chart>',
          controller: MainCtrl
          })
      })
  }
  </script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<div ng-view></div>

</div>
<footer class="container-fluid text-center">
    <p>Created by: Gustavo Sanchez, Arjun Grewal, Kenneth Alegria, Luke Midgley and Greg Smith</p>
    <p>Made with PHP, Bootstrap, JS and MySQL</p>
            <p>Contact information: <a href="mailto:gsanchezcollado@gmail.com">
              gsanchezcollado@gmail.com</a></p>
</footer>
</body>
</html>
