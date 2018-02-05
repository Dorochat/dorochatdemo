<?php
session_start();// start session

require_once('classes/User.php');// include User Core class

$user = new User();// create New class Object
$user_id = $_SESSION['user_session'];// Logged in User ID

if($_POST){

$Cid=strip_tags($_POST['Convid']);// conversation ID

	try{

	if($user->unBlockUser($Cid,$user_id)){// if Blocking Is Fine

		echo "UnBlocked Successfully";

	}
	else{

echo "Unable to Unblock the user";

	}

}
catch(PDOException $e)
        {
            echo $e->getMessage();
        }

}

//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!


?>