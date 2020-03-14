<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel = "stylesheet" href = "css/chatStyle.css"/>

    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">
    </script>

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
        <li><a href="./homePat.php">Home</a></li>
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
<body>

<div id = "wrapper">

    <h1>Hello <?php session_start(); echo $_SESSION['username']; ?></h1>

    <div class = "chat_wrapper">

        <div id = "chat"></div>

        <form method = "POST" id = "messageForm">
            <textarea name = "message" cols = "30" rows = "7" class = "textarea"></textarea>
        </form>

    </div>

</div>

<script>

loadChat();

    setInterval(function(){
        loadChat();
    }, 1000);



    function loadChat() {
        $.post('messages.php?action=getMessages', function(response){
              
              var scrollpos = $('#chat').scrollTop();
              var scrollpos = parseInt(scrollpos) + 520;
              var scrollHeight = $('#chat').prop('scrollHeight');
              
              $('#chat').html(response);

              if( scrollpos < scrollHeight){

              }else {
                $('#chat').scrollTop( $('#chat').prop('scrollHeight') );  
              }       
        });
    }


    $('.textarea').keyup(function(e){
        if(e.which == 13 ) {
            $('form').submit();
        }
    });

    $('form').submit(function(){

        var message = $('.textarea').val();
      $.post('messages.php?action=sendMessage&message=' + message, function(response){
          if(response == 1){
            loadChat();
            document.getElementById('messageForm').reset();
          }
      });  

        return false;
    });

</script>
    
</body>
</html>