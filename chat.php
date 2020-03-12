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