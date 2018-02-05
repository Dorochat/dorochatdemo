<?php
session_start();//Start session

require_once('classes/User.php');//User class

$user = new User();// create  class Object 

if($_POST){

$Cid=strip_tags($_POST['Convid']);// conversation ID

	try{

	if($user->delete($Cid)){// Pass in Conversation Id to Delete Method

		echo "Deleted Successfully";

	}
	else{

echo "Script Could not delete your conversation";

	}

}
catch(PDOException $e)
        {
            echo $e->getMessage();
        }

}



//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!

?>