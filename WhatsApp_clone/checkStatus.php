<?php
session_start();//start session
include("config/dbconfig.php");//Database Connection
$Sessionuser_id = $_SESSION['user_session'];// Get The Id of Logged In User

$database= new Database();// Create database Object, that can be use to instantiate Dabase class

if($_POST){

$Cid=strip_tags($_POST['id']);//conversationId

try{

$getUserId= $database->dbConnection()->prepare("SELECT c.coId, c.coUserOne, c.coUserTwo, c.blocked, c.blockedBy, u.uID, u.firstname FROM conversation c,users u
 WHERE CASE WHEN c.coUserOne = u.uID
THEN c.coUserTwo ='$Sessionuser_id'
WHEN c.coUserOne ='$Sessionuser_id'
THEN c.coUserTwo = u.uID
END AND (
c.coUserOne ='$Sessionuser_id'
OR c.coUserTwo ='$Sessionuser_id'
) AND c.coId='$Cid' ");
$getUserId->execute();

			$BlockedUser= $getUserId->fetch(PDO::FETCH_ASSOC);

			$uId=$BlockedUser['uID'];
			$status=$BlockedUser['blocked'];


if($uId==$status){
?>
<a href="#" onclick="demo.showSwal('unblock-user')" class="blockedTrue">
                                        <i class="pe-7s-less"></i> UnBlock user
                                    </a>
<?php

}
else{
?>
<a href="#" onclick="demo.showSwal('warning-message-and-cancel')">
                                        <i class="pe-7s-less"></i> Block user
                                    </a>
<?php

}


		 }
		 catch(PDOException $e){

		 	echo $e->getMessage();


		 }


}


//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!

?>