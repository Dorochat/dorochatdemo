<?php
require_once("session.php");//Start session
    
    require_once("classes/User.php");//include User class

    $auth_user = new User();// Create New Object
    require_once("emojione.php");// Include Emoji

if($_POST){

$searchQuery=strip_tags($_POST['search']);//  Search data to be sent to the server


$user_id = $_SESSION['user_session'];// Logged in User ID

$result_query= $auth_user->runQuery("select c.coID, c.blocked, c.blockedBy, u.uID, u.firstname, u.Lastname, u.profile, m.crReply, m.crTime, m.crConFK
        FROM users u, conversation c, conversation_reply m
        LEFT JOIN conversation_reply m2
        ON (m.crConFK = m2.crConFK AND m.crID < m2.crID) -- this is to select last message
        WHERE
            CASE
              WHEN c.coUserOne = $user_id
              THEN c.coUserTwo = u.uID
              WHEN c.coUserTwo = $user_id
              THEN c.coUserOne= u.uID
            END
        AND
        c.coID = m.crConFK AND (u.firstname LIKE '$searchQuery%' OR u.Lastname LIKE '$searchQuery%')
        AND
        (c.coUserOne = $user_id OR c.coUserTwo = $user_id) 
        AND
        m2.crID IS NULL ORDER BY m.crID DESC ");
$result_query->execute();

if($result_query->rowCount()){

while($conv_row=$result_query->fetch(PDO::FETCH_ASSOC)){

$c_id_fk=$conv_row['crConFK'];

/****count new message in each conversation**********/
$sql_count=$auth_user->runQuery("SELECT count( * ) AS replies
FROM conversation_reply
WHERE crConFK ='$c_id_fk'
AND (
user_two_read = 'no'
AND crUserFK NOT
IN ( '$user_id' )
) ");

$sql_count->execute();

$replyiesnotification=$sql_count->fetch(PDO::FETCH_ASSOC);

$replyiesnotifi=$replyiesnotification['replies'];
/****count new message in each conversation end here**********/



?>

<div id="friends">
            <div class="friend" onclick="chat('<?php echo $conv_row['coID'];?>')">

            <?php if($replyiesnotifi==0){
?>

<?php
}
else{
?>
<span class="message_notification"><?php echo $replyiesnotifi; ?></span>
<?php
}
?>
         <div class="Userprofile">

                <?php if($conv_row['profile']==""){
                  ?>
                  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" />

                  <?php

                  } 
                  else{
                    ?>
                    <img src="profiles/<?php echo $conv_row['profile']; ?>">

                    <?php
                  } 
                  ?>

                </div>


                <p>
                   <span class="username"><?php if($conv_row['blocked']==$conv_row['uID'] && $conv_row['blockedBy']==$user_id){//Show for those ID are Blocked

                      ?>

                     <strong style="color:#ff8000; font-size: 16px;"><?php echo $conv_row['firstname'];?> <?php echo $conv_row['Lastname'];?></strong>
                      <?php

                      }
                      else{?>

                      <strong><?php echo $conv_row['firstname'];?> <?php echo $conv_row['Lastname'];?></strong>

                        <?php }?></span><br><!--check wether this guy is blocked or Not-->
                    <span class="user_conversation_reply"><?php echo $client->shortnameToImage($conv_row['crReply']);?></span>
                </p>
                <?php if($conv_row['uID']==$auth_user->inActiveUsers()){

                  ?>

                  <div class="status away"></div>

                  <?php

                }
                else if($conv_row['uID']==$auth_user->onlineUsers($conv_row['uID'])){// supply UserId to OnlineUsers Function To check wether this Id exit in the table or Not
?>
<div class="status available"></div>
<?php

                }
                else if($conv_row['uID']!==$auth_user->onlineUsers($conv_row['uID'])){// supply UserId to OnlineUsers Function To check wether this Id exit in the table or Not-> here we're proving that the user has Logged out
?>
<div class="status inactive"></div>
<?php

                }
                ?>
            </div>

            </div>
<?php
}

}
else{
  ?>

<img src="img/blured_chat.png" style="height: 100%; width: 100%">

  <?php


}
?>    
    </div>  
    </div>


<?php

}

//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!
?>
