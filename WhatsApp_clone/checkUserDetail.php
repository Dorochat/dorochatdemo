<?php
session_start();//start session
include("config/dbconfig.php");//Database Connection
$Sessionuser_id = $_SESSION['user_session'];// Get The Id of Logged In User

$database= new Database();// Create database Object, that can be use to instantiate Dabase class

if($_POST){

$Cid=strip_tags($_POST['id']);//conversation ID Passed in By a User via AJax Call, ...js/index.js..//

try{

$getUser= $database->dbConnection()->prepare("SELECT c.coId, c.coUserOne, c.coUserTwo, c.blocked, c.blockedBy, u.uID, u.firstname,u.lastname,u.profile FROM conversation c,users u
 WHERE CASE WHEN c.coUserOne = u.uID
THEN c.coUserTwo ='$Sessionuser_id'
WHEN c.coUserOne ='$Sessionuser_id'
THEN c.coUserTwo = u.uID
END AND (
c.coUserOne ='$Sessionuser_id'
OR c.coUserTwo ='$Sessionuser_id'
) AND c.coId='$Cid' ");
$getUser->execute();

			$UserDetails= $getUser->fetch(PDO::FETCH_ASSOC);

			$uId=$UserDetails['uID'];
			$firstname= $UserDetails['firstname'];
			$lastname = $UserDetails['lastname'];

?>

                <div class="navbar-minimize">

                   <div class="Userprofile" style="margin-top: 4px;">

                    <?php if($UserDetails['profile']==""){
                  ?>
                  <img src="img/avatar.png" alt="Avatar" style="height: 50px; width: 50px; border-radius: 50%;">

                  <?php

                  } 
                  else{
                    ?>
                    <img src="profiles/<?php echo $UserDetails['profile']; ?>" style="height: 50px; width: 50px; border-radius: 50%;">

                    <?php
                  } 
                  ?>


                        
                  </div>
                </div>
                    <a class="navbar-brand" href="#"><?php echo $firstname ?> <?php echo $lastname; ?></a>
                </div>

                 

<?php




		 }
		 catch(PDOException $e){

		 	echo $e->getMessage();


		 }


}



//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!

?>

