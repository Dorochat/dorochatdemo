<?php
session_start();//start session

include("config/dbconfig.php");//Database Connection

$Sessionuser_id = $_SESSION['user_session'];// Get The Id of Logged In User

$database= new Database();// Create database Object, that can be use to instantiate Dabase class

date_default_timezone_set('America/New_York');//or change to whatever timezone you want

if($_POST){

    $message=strip_tags($_POST['msg']);//Message variable
    $conversationId=strip_tags($_POST['conVID']);//conversation ID

$ip = gethostbyname($_SERVER['REMOTE_ADDR']);

$packed = chr(127) . chr(0) . chr(0) . chr(1);
$expanded = inet_ntop($packed); //user Ip address
$time=date("Y/m/d h:i:s");
$read_status="1";


    if(!empty($message || $conversationId)){

    	if($conversationId=="" || $conversationId==0){
    		?>
 <div class="message sent">
                This Message Was not sent because there's no conversation selected!. Please select one from the left side. Thank you.

</div>

<?php

die();

    	}//check wether conversation exist ENDS HERE.

        //lets check wether this guy has blocked his/her friend

        $blockedSql= $database->dbConnection()->prepare("SELECT * FROM conversation WHERE coID= ? AND blockedBy= ?");
        $blockedSql->bindvalue(1, $conversationId);
        $blockedSql->bindvalue(2, $Sessionuser_id);
        $blockedSql->execute();

        $userStatus= $blockedSql->fetch(PDO::FETCH_ASSOC);


        if($userStatus['blocked'] !="" && $userStatus['blockedBy']==$Sessionuser_id ){

                    ?>
 <div class="message sent">
                <p style="color: red">You Blocked this user!. Unblock them and try again. Thank you.</p>

</div>

<?php


die();
        }





$queryReplies=$database->dbConnection()->prepare("INSERT INTO conversation_reply SET crReply= ?, crUserFK= ?, crConFK= ?, user_one_read= ?, crTime= ?, crIP= ?");

$queryReplies->bindvalue(1, $message);
$queryReplies->bindvalue(2, $Sessionuser_id);
$queryReplies->bindvalue(3, $conversationId);
$queryReplies->bindvalue(4, $read_status);
$queryReplies->bindvalue(5, $time);
$queryReplies->bindvalue(6, $expanded);

$queryReplies->execute();

if($queryReplies){
//you can here a notification to let you know whether the message has been send successfully

    /////////////

$getId=$database->dbConnection()->prepare("SELECT * FROM conversation_reply where crConFK= ? ");
$getId->bindvalue(1, $conversationId);

$getId->execute();

while($userIds = $getId->fetch(PDO::FETCH_ASSOC)){

$user_id=$userIds['crUserFK'];

//update conversation immediately
if($userIds['crUserFK'] !==$Sessionuser_id ){

$update_conversation_seen=$database->dbConnection()->prepare("update conversation_reply SET user_two_read= ? where crConFK= ? AND crUserFK = ?");
$update_conversation_seen->bindvalue(1,'1');
$update_conversation_seen->bindvalue(2,$conversationId);
$update_conversation_seen->bindvalue(3,$user_id);
$update_conversation_seen->execute();

}
}
    /////////////////////////
}
else{
echo "Oops some errors occured how about reviewing your query, you can check if all table column exist.";
}
    }
    else{

       echo "No conversation selected!";
    }

}

//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!
?>