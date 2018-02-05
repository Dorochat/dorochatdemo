<?php
require_once('config/dbconfig.php');// include Our Database Connection


class User// crate Our Class User
{	

	private $conn;// declare Connection variable
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }//connection to the database..!!
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function createChat($msg,$userId){

		$value="1";


		try{

$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);

$ip = gethostbyname($_SERVER['REMOTE_ADDR']);

$packed = chr(127) . chr(0) . chr(0) . chr(1);
$expanded = inet_ntop($packed); //user Ip address
$time=date("Y/m/d h:i:s");

$user_id = $_SESSION['user_session'];

			//lets first check wether this conversation already exist,//

$convcheck = $this->conn->prepare("SELECT * FROM conversation where (coUserOne='$userId' and coUserTwo='$user_id') or (coUserOne='$user_id' and coUserTwo='$userId')");
$convcheck->execute();

$con_id=$convcheck->fetch(PDO::FETCH_ASSOC);




if($convcheck->rowCount()){ //Now if conversation exist, we dont need to have duplicate ID's so we select Its Id and Insert a reply in Conversation reply table//

				

			$conv_r= $this->conn->prepare("INSERT INTO conversation_reply(crReply,crUserFK,crIP,crTime,crConFK,user_one_read) 
		                                               VALUES(:crReply, :crUserFK, :crIP, :crTime, :crConFK, :useroneRead)");
												  
			$conv_r->bindparam(":crReply", $msg);
			$conv_r->bindparam(":crUserFK", $user_id);
			$conv_r->bindparam(":crIP", $expanded);	
			$conv_r->bindparam(":crTime", $time);	
			$conv_r->bindparam(":crConFK", $con_id['coID']);
			$conv_r->bindparam(":useroneRead", $value);										  
				
			$conv_r->execute();

					die(); 

				}
				else{ //There's No conversation found in the table so Now lets create one.





//immediately you have to Update Conversation reply table for new conversation

		$conv = $this->conn->prepare("INSERT INTO conversation(coUserOne,coUserTwo,coIP,coTime) 
		                                               VALUES(:coUserOne, :coUserTwo, :coIP, :coTime)");
												  
			$conv->bindparam(":coUserOne", $user_id);
			$conv->bindparam(":coUserTwo", $userId);
			$conv->bindparam(":coIP", $expanded);	
			$conv->bindparam(":coTime", $time);										  
				
			$conv->execute();


//Lets Now Get The Last Insterted ID to Insert Into conversation_reply
			$last_id=$this->conn->lastInsertId();


$convcheck = $this->conn->prepare("SELECT * FROM conversation where (coUserOne='$userId' and coUserTwo='$user_id') or (coUserOne='$user_id' and coUserTwo='$userId')");
$convcheck->execute();

$con_id=$convcheck->fetch(PDO::FETCH_ASSOC);


		$Newconv_r= $this->conn->prepare("INSERT INTO conversation_reply(crReply,crUserFK,crIP,crTime,crConFK,user_one_read) 
		                                               VALUES(:crReply, :crUserFK, :crIP, :crTime, :crConFK, :useroneRead)");
												  
			$Newconv_r->bindparam(":crReply", $msg);
			$Newconv_r->bindparam(":crUserFK", $user_id);
			$Newconv_r->bindparam(":crIP", $expanded);	
			$Newconv_r->bindparam(":crTime", $time);	
			$Newconv_r->bindparam(":crConFK", $last_id);
			$Newconv_r->bindparam(":useroneRead", $value);											  
				
			$Newconv_r->execute();
			
			return $conv;

				}

	}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	


	}

	// delete conversation

	public function delete($cid){

		 try{

		 	$delete_conversation = $this->conn->prepare("SET FOREIGN_KEY_CHECKS = 0; DELETE FROM `conversation` WHERE coID= ?; SET FOREIGN_KEY_CHECKS = 1");
		 	$delete_conversation->bindvalue(1, $cid);
		 	$delete_conversation->execute();//delete conversation from conversation table


//Delete all chat messages From conversation_reply as well...

		 	$cleanchat= $this->conn->prepare("DELETE FROM conversation_reply WHERE crConFK= ? ");
		 	$cleanchat->bindvalue(1, $cid);
            $cleanchat->execute();
 }
		 catch(PDOException $e){

		 	echo $e->getMessage();


		 }
	}

	//Unblock User

	public function unBlockUser($cid,$userId){

		try{

			$UnblockUser=$this->conn->prepare("UPDATE conversation SET blocked= ?, blockedBy= ? WHERE coID= ? AND blockedBy= ?");
			$UnblockUser->bindvalue(1, '0');
			$UnblockUser->bindvalue(2, '0');
			$UnblockUser->bindvalue(3, $cid);
			$UnblockUser->bindvalue(4, $userId);
			$UnblockUser->execute();


		 }
		 catch(PDOException $e){

		 	echo $e->getMessage();


		 }


	}

	//register New User
	public function register($fname,$lname,$umail,$upass,$time)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO users(firstname,Lastname,email,password,joined) 
		                                               VALUES(:fname, :lname, :umail, :upass, :joined)");
												  
			$stmt->bindparam(":fname", $fname);
			$stmt->bindparam(":lname", $lname);
			$stmt->bindparam(":umail", $umail);	
			$stmt->bindparam(":upass", $new_password);	
			$stmt->bindparam(":joined", $time);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	// process Login 
	public function doLogin($useremail,$userPass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT uID,firstname, Lastname, email, password FROM users WHERE email=:user_mail ");
			$stmt->bindparam(':user_mail',$useremail);
			$stmt->execute();

			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($userPass, $userRow['password']))
				{
					$_SESSION['user_session'] = $userRow['uID'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	// check wether this Guy is Logged i mean if all creadentials supplied by User are correct
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{

//lets add this guy to online users

$session=session_id();
$time=time();
$loggedIN=$_SESSION['user_session'];


//check for the session
$sessionSQl=$this->conn->prepare("SELECT * FROM  user_online WHERE session= ? AND userId= ?");
$sessionSQl->bindvalue(1, $session);
$sessionSQl->bindvalue(2, $loggedIN);

$sessionSQl->execute();
$nmber= $sessionSQl->rowCount();

if($nmber=='0'){//if this session is not available, then create it.

	$sessIONcreate=$this->conn->prepare("INSERT INTO user_online SET session= ? ,userId= ?, time= ?, status= ? ");
	$sessIONcreate->bindvalue(1, $session);
	$sessIONcreate->bindvalue(2, $loggedIN);
	$sessIONcreate->bindvalue(3, $time);
	$sessIONcreate->bindvalue(4, 'Online');
	$sessIONcreate->execute();


}
else {

	$SessionUpdate= $this->conn->prepare("UPDATE user_online SET time= ? WHERE userId= ?");
	$SessionUpdate->bindvalue(1, $time);
	$SessionUpdate->bindvalue(2, $loggedIN);
	$SessionUpdate->execute();
}



			return true;
		}
	}
//show online users

public function onlineUsers($uId){

$session=session_id();
$time=time();
$loggedIN=$_SESSION['user_session'];


$time_check=$time-600; //SET TIME 10 Minute

$current= $time-500; //SET TIME 5 Minute [if a user spend five minutes without coming to the site The we update the status to current]



	$onlineUsers=$this->conn->prepare("SELECT * FROM user_online WHERE userId= ? ");
    $onlineUsers->bindvalue(1, $uId);

	$onlineUsers->execute();

	while($rowsFound=$onlineUsers->fetch(PDO::FETCH_ASSOC)){

		$userID=$rowsFound['userId'];

		return $userID;


	}


	//we can Update the status to busy Now

	$CurrentUser=$this->conn->prepare("UPDATE user_online SET status= ? WHERE userId= ? AND session= ? AND time<$current ");
        
    $CurrentUser->bindvalue(1, "busy");
    $CurrentUser->bindvalue(2, $loggedIN);
     $CurrentUser->bindvalue(3, $session);

    $CurrentUser->execute();




// if over 10 minute, delete session 

	$ExpiredSession= $this->conn->prepare("DELETE FROM user_online WHERE time<$time_check ");
	$ExpiredSession->execute();





}	


//check for inactive users on the site

public function inActiveUsers(){

$time=time();
$currentime_check=$time-500; //SET TIME 5 Minute

$checkUserStatus= $this->conn->prepare("SELECT * FROM user_online WHERE time<$currentime_check ");
$checkUserStatus->execute();

while($rows=$checkUserStatus->fetch(PDO::FETCH_ASSOC)){

	$userIDs=$rows['userId'];

	return $userIDs;
}

}


//Count How many are Online Now

public function countOnlineUsers(){

	$onlineUsers=$this->conn->prepare("SELECT * FROM user_online ");

	$onlineUsers->execute();

	$howMany= $onlineUsers->rowCount();

	return $howMany;

}


	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{

$session=session_id();


//Delete this Guy from Online Users

	$DeleteSession= $this->conn->prepare("DELETE FROM user_online WHERE session= ? AND userId='".$_SESSION['user_session']."' ");

	$DeleteSession->bindvalue(1, $session);

	$DeleteSession->execute();

		session_destroy();

		unset($_SESSION['user_session']);

		return true;
	}
}

//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!
?>