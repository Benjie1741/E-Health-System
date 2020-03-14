<?php
include('includes/conn.inc.php');

session_start();
$patient_id = $_SESSION['chat_pID'];
$doc_id = $_SESSION['chat_dID'];

$timestamp = time();
$_SESSION['msgTime'] = (date("F d, Y h:i:s A", $timestamp));

    //Switch for sending and getting messages
    switch( $_REQUEST['action']){

        //Inserts the data into the database
        case "sendMessage":
          //Checks is message is empty
          if($_REQUEST['message'] != ""){
            $query = $pdo->prepare("INSERT INTO chatmessages SET displayName=?, pID=?, dID=?, message=?, date=?");
            $run = $query->execute([$_SESSION['username'], $_SESSION['chat_pID'], $_SESSION['chat_dID'], $_REQUEST['message'], $_SESSION['msgTime']]);
  
            if ( $run ) {
              echo 1;
              exit;
            }
          }
        break;

        //Gets everything from the database, based on the patient id and the doctor id
        case "getMessages";
        $query = $pdo->prepare("SELECT * FROM chatmessages WHERE pID = $patient_id AND dID = $doc_id");
        $run = $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        //Display the chat
        $chat = '';
        foreach( $result as $message ){
          $chat .= '<div class = "single_message">
          <strong>'.$message->displayName.': </strong> '.$message->message.'
          <span>'.date('h:i a',strtotime($message->date)).'</span>
          </div>';
        }
        echo $chat;
      break;
    }
?>
