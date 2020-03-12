<?php

include('includes/conn.inc.php');

    switch( $_REQUEST['action']){

        case "sendMessage":

          session_start();

          $query = $pdo->prepare("INSERT INTO chatmessages SET user=?, message=?");
          
          $run = $query->execute([$_SESSION['username'], $_REQUEST['message']]);

          if ( $run ) {
            echo 1;
            exit;
          }
        break;

        case "getMessages";

        $query = $pdo->prepare("SELECT * FROM chatmessages");
        $run = $query->execute();

        $result = $query->fetchAll(PDO::FETCH_OBJ);

        $chat = '';
        foreach( $result as $message ){
          
          $chat .= '<div class = "single_message">
          <strong>'.$message->user.': </strong> '.$message->message.'
          <span>'.date('h:i a',strtotime($message->date)).'</span>
          
          </div>';
        }

        echo $chat;

      break;

    }
?>