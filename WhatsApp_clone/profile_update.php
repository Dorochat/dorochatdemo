<?php
session_start();//start session
include("config/dbconfig.php");//Database Connection
$Sessionuser_id = $_SESSION['user_session'];// Get The Id of Logged In User

$database= new Database();// Create database Object, that can be use to instantiate Dabase class


$path = "profiles/";

$valid_formats = array("jpg", "png", "gif","JPG","doc","docx","ppt","pdf");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
 {
  $name = $_FILES['photoimg']['name'];
  $size = $_FILES['photoimg']['size'];
  if(strlen($name))
         {
	list($txt, $ext) = explode(".", $name);
	if(in_array($ext,$valid_formats))
		{
		if($size<(1024*1024))
			{
			$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
			
			$tmp = $_FILES['photoimg']['tmp_name'];
			
			if(move_uploaded_file($tmp, $path.$actual_image_name))
				{
				$time=time();
				$command=$database->dbConnection()->prepare("UPDATE users SET profile= ? where uID= ?");
				$command->bindvalue(1, $actual_image_name);
				$command->bindvalue(2, $Sessionuser_id);
				$command->execute();
				
				$query=$database->dbConnection()->prepare("SELECT uID,profile from users where profile= ? AND uID= ? ");
				$query->bindvalue(1, $actual_image_name);
				$query->bindvalue(2, $Sessionuser_id);
				$query->execute();

				$result=$query->fetch(PDO::FETCH_ASSOC);

				$id=$result['uID'];
				
				echo "<img src='profiles/".$actual_image_name."'  class='preview' id='$id'>";
							
					
				}
			else
			echo "failed";
		}
	else
	echo "Image file size max 250k";					
          }
else
echo "Invalid file format..";	 
}
				
else
echo "Please select image..!";
				
exit;
}

//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!
?>