<?php

	session_start(); // start Session
	
	require_once 'classes/User.php';// include our Core class

	$session = new User();// Create New clas Object

	// if user session is not active(not loggedin) this page will help 'home.php and profile.php' to redirect to login page
	// put this file within secured pages that users (users can't access without login)
	
	if(!$session->is_loggedin())// if this User is Not logged In Then
	{
		// session no set redirects to login page
		$session->redirect('login.php');
		
	}