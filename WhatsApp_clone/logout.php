<?php
	require_once('session.php');// start Session
	require_once('classes/User.php');// Include User Class
	$user_logout = new User();//Create New Object
	
	if($user_logout->is_loggedin()!="")// check wether User Is Logged In
	{
		$user_logout->redirect('home.php');//if is true then redirect to home.php
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true") // if a user  wish to logout 
	{
		$user_logout->doLogout();// process Logout
		$user_logout->redirect('login.php');// take the user to login.php 
	}
