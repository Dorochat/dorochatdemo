<?php
session_start();// start session

require_once('classes/User.php');// Include User class

$user = new User();//create New Object so that we can Use User class Methods

if($_POST){

	$msg=strip_tags($_POST['msg']);// Text Message Send By User

	$ID=strip_tags($_POST['userID']);// User ID--Who is Sending a Message==> actually This is Logged in User

try{

	if($user->createChat($msg,$ID)){// send Our data Msg and Id to CreateChat Method Which will Query database and Create A new Chat for us

		echo "created successfull";

	}
	else{

echo "Something is wrong";

	}

}
catch(PDOException $e)
        {
            echo $e->getMessage();
        }



}



//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!

?>