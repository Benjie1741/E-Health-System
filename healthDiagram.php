<?php
  require('includes/conn.inc.php');
  require('includes/functions.inc.php');

  $sType = safeString($_GET['type']); //Changes depending on what you click
  $user_id = "1";                     //NEEDS to change depending on the logged in user

  if ($sType != "exerciseDone"){
    $sql = "SELECT $sType, date FROM healthData WHERE userID = $user_id";
  } else {
    $sql = "SELECT $sType, date, hoursOfExercise FROM healthData WHERE userID = $user_id";
  }
  $stmt = $pdo->query($sql);

  //Arrays for data
  $dataPoints = array();
  $datePoints = array();
?>

<!DOCTYPE html>
<html ng-app="GraphData">

<head>
  <title>ARJ - Health Diagram</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.3/angular.js"></script>
  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="chart.js"></script>

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
        <select id="select">
        <option value="line">line</option>
        <option value="bar">bar</option>
        <option value="pie">pie</option>
        <option value="scatter">scatter</option>
        </select>
        <br>

        <!-- PHP for storing the data in the arrays from the database -->
        <?php 
        $i = 0;
				  while($row =$stmt->fetchObject()){
            if ($i < 7 ) {
            array_push($dataPoints, array("y"=>$row->$sType));
            $datePoints[] = $row->date;
            $i++;
            echo $sType;
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
              "xData": [ dateT[6], dateT[5], dateT[4],  dateT[3],  dateT[2],  dateT[1],  dateT[0]],              
              "yData":[{ "data": dataPoints }]
            }      
            $scope.lineChartYData=data.yData
            $scope.lineChartXData=data.xData
        }
    </script>

    <!-- Displaying the graph -->
    <script>
    var type = "line"
    $("#select" ).on('change', function() { 
    //loadGraph( $(this).val() );
    type = $(this).val();
    });
    console.log("type: ", type)
    angular.module('GraphData',['AngularChart'], function( $routeProvider, $locationProvider ){
        $routeProvider.when('/',{
            template: '<chart title="Line Data" type='+type+' xData="lineChartXData" yData="lineChartYData" xName="Values" yName="Date"></chart>',
            controller: MainCtrl
            })
    })
    </script>

<div ng-view></div>

</div>
</body>

<footer style="padding-top:3%" class="container-fluid text-center">
    <br>
    <p>Copyright &copy; 2020</p>
    <p>Footer Text</p>
</footer>
</html>