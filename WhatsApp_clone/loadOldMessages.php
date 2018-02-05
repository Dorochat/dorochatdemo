<?php
session_start();//start session
include("config/dbconfig.php");//Database Connection
$Sessionuser_id = $_SESSION['user_session'];// Get The Id of Logged In User

$database= new Database();// Create database Object, that can be use to instantiate Dabase class

require_once("emojione.php");

$page_no=$_GET['pageNo'];
$startLimit= ($page_no-1)* 2;


$conversation_id=$_SESSION['current_conversation_id'];// stored conversation ID in session so that we can use it  while exchanging replies in a conversation


//Lets first Check  wether you blocked the User before Getting The Message

$getUserId= $database->dbConnection()->prepare("SELECT c.coId, c.coUserOne, c.coUserTwo,c.blocked, c.blockedBy, u.uID, u.firstname FROM conversation c,users u
 WHERE CASE WHEN c.coUserOne = u.uID
THEN c.coUserTwo ='$Sessionuser_id'
WHEN c.coUserOne ='$Sessionuser_id'
THEN c.coUserTwo = u.uID
END AND (
c.coUserOne ='$Sessionuser_id'
OR c.coUserTwo ='$Sessionuser_id'
) AND c.coId='$conversation_id' ");
$getUserId->execute();

$BlockedUser= $getUserId->fetch(PDO::FETCH_ASSOC);

if($BlockedUser['uID']== $BlockedUser['blocked'] && $BlockedUser['blockedBy']==$Sessionuser_id){

	?>

	<div id="WrapBlockNotification">


<div class="ball">
  <div class="halo"></div>
  <div class="msg-count">1</div>
  <div class="notif">
   <div class="notification"><p class="text">You blocked this user, Unblocker them and you will be able to chat again</p></div>
    <div class="arrow"></div>
  </div>
</div>


</div>

	<?php

	die();
}//Blocking system Ends here


$query= $database->dbConnection()->prepare("SELECT *
FROM (SELECT R.crID,R.crTime,R.crReply,R.attachment,R.crUserFK,R.crConFK,R.user_one_read,R.user_two_read,U.uID,U.firstname,U.lastname,U.profile FROM users U, conversation_reply R WHERE R.crUserFK=U.uID and R.crConFK='$conversation_id' ORDER BY crID DESC
LIMIT $startLimit,2)sub
ORDER BY crID ASC");//select Conversation reply to bring all replies that belong to a particular conversation ID

$query->execute();


while($row=$query->fetch(PDO::FETCH_ASSOC))
{
$cr_id=$row['crID'];
$time=$row['crTime'];
$reply=$row['crReply'];
$user_one_read=$row['user_one_read'];
$user_two_read=$row['user_two_read'];
$user_id_fk=$row['crUserFK'];
$user_id=$row['uID'];
$username=$row['firstname'];
$profile=$row['profile'];
$c_id_fk=$row['crConFK'];
$attachment=$row['attachment'];

$sql_username=$database->dbConnection()->prepare("select * from users where uID='$user_id'");//check 

while($usernames_row=$sql_username->fetch(PDO::FETCH_ASSOC)){
 
 $usernames=$usernames_row['username'];
} 
?>
<input type="hidden" name="currentResult" id="CurrentResult" value="1">
<?php
/****check wether we have a message that has attachement**************/

      	$sql_get_uploaded_attachment1=$database->dbConnection()->prepare("select attachment_owners.id as attach_id,attachment_owners.user_id as userid,attachment_owners.attach_id as upload_id,attachment_owners.c_id as conv_id,attachment_owners.date as uploaded_time,attachment.id as file_id,attachment.image_name as image_name,attachment.date as time from attachment_owners,attachment where attachment.id=attachment_owners.attach_id and(attachment_owners.user_id='$user_id_fk' AND attachment_owners.c_id='$c_id_fk')");

while($found_rowsq=$sql_get_uploaded_attachment1->fetch(PDO::FETCH_ASSOC)){
$owner_id=$found_rowsq['attach_id'];
$owner_id_fk=$found_rowsq['userid'];
$upload_id=$found_rowsq['upload_id'];
$filez=$found_rowsq['conv_id'];
$image_name=$found_rowsq['image_name'];

}



	  if($user_id !=$Sessionuser_id){?>

	     <div class="message received">
	      <div class="conversation_id" id="<?php echo $conversation_id; ?>">
        </div>                
          <span id="random"> <p><?php echo $client->shortnameToImage($reply); ?></p></span>
        
         <span class="metadata"><span class="time"><?php echo $time; ?></span></span>       
		 

<?php if(!empty($filez)==$c_id_fk && $owner_id_fk==$user_id_fk)

{?>


<?php if($filez==$c_id_fk && $attachment=='1'){

	$info = new SplFileInfo($reply);

if($info->getExtension()=="docx" || $info->getExtension()=="pdf"){ /***if there's an attachement then lets check its extensions, you can add as many extension as you wish***/
?> 
<a href=""><img src="img/attached_file.png"   style="height: 120px; width: 120px;" /></a>
<?php
}
else{/***if there's no such extension in message, then display msg***/

	?>
<img src="attachment/<?php echo $reply; ?>"   style="height: 120px; width: 120px;" />
	<?php
}
}
?>

<?php 
} 
else
{
	}?>

	  </div>
	 <?php }
	  else{ 
	  ?>


   <div class="message sent">

     <?php if(!empty($filez)==$c_id_fk && $owner_id_fk==$user_id_fk){
?>
<?php if(!empty($filez)==$c_id_fk && $attachment=='1'){/***check wether there's an attachement in the conversation***/

$info = new SplFileInfo($reply);

if($info->getExtension()=="docx" || $info->getExtension()=="pdf"){ /***if there's an attachement then lets check its extensions, you can add as many extension as you wish***/
?> 

<?php
}
else{/***if there's no such extension in message, then display msg***/

	?>
<img src="attachment/<?php echo $reply; ?>"   style="height: 120px; width: 120px;" /> <span class="seen"> <?php if($user_one_read=='yes' and $user_two_read=='no'){?> <img src="img/msg_send.png" /> <?php } else{?> <span class="update_seen"><img src="img/seen.png" style="height:12px; width:16px;"  /></span> <?php } ?> </span>
	<?php
}
?>
<?php 
} 
else{

?>
 <p><?php echo $reply; ?>

</p>
 
<?php

	} ?>

<?php
}/*****checking the attachement ends here*******/

else{

	?>
 <p><?php echo $client->shortnameToImage($reply); ?> <span class="seen"> <?php if($user_one_read=='1' and $user_two_read=='0'){?> <span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck" x="2047" y="2061"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#92a58c"/></svg> <?php } else{?> 
 <span class="metadata">
                      <span class="time"><?php echo $time; ?></span><span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#4fc3f7"/></svg></span>
                  </span> <?php } ?> </span></p>

	<?php

}?>
       


	     
	  </div>
    <?php
}
	
}
//update conversation immediately

$get_users=$database->dbConnection()->prepare("select coUserOne,coUserTwo from conversation where coID = ?");
$get_users->bindvalue(1,$conversation_id);
$get_users->execute();
while($usersdetails=$get_users->fetch(PDO::FETCH_ASSOC)){
 
  $first=$usersdetails['coUserOne'];
  $second=$usersdetails['coUserTwo'];

$conv_query=$database->dbConnection()->prepare("select crUserFK from conversation_reply where crConFK= ? order by crID DESC limit 1");
$conv_query->bindvalue(1,$conversation_id);
$conv_query->execute();

while($conrows=$conv_query->fetch(PDO::FETCH_ASSOC))
{
$userid=$conrows['crUserFK'];


if($userid !==$Sessionuser_id ){

$update_conversation_seen=$database->dbConnection()->prepare("update conversation_reply SET user_two_read= ? where crConFK= ? AND crUserFK = ?");
$update_conversation_seen->bindvalue(1,'yes');
$update_conversation_seen->bindvalue(2,$conversation_id);
$update_conversation_seen->bindvalue(3,$userid);
$update_conversation_seen->execute();

}

 
  }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///This Issue of Checking wether a file Exist in a chat or not you can Remove or Leave it there because in our next Version we intent to use them as well, so if you dont want to have problem configurithem again you better leave them so that next Version you Update only  few files//
//File to be or Not to be Replace by You! its your choice Now

//<?php if(!empty($filez)==$c_id_fk && $owner_id_fk==$user_id_fk)


//<?php if($filez==$c_id_fk && $attachment=='1'){

	//$info = new SplFileInfo($reply);

//if($info->getExtension()=="docx" || $info->getExtension()=="pdf"){ /***if there's an attachement then lets check its extensions, you can add as many extension as you wish***/
///// 
//<a href=""><img src="img/attached_file.png"   style="height: 120px; width: 120px;" /></a>
//<?php
//}
//else{/***if there's no such extension in message, then display msg***/

	//
//<img src="attachment/<?php echo $reply;

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!



?>


<div class="preview_Img" style="display: none;">
	
<div class="bubble me">

<div id="file_preview"></div>

</div>

</div>

