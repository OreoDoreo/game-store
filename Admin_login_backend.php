<?php 
	include "DB_connection.php";
	include "function.php";

	// Checking whether log in button is pressed or not. 
	// If pressed, then username and password is set 

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
	}

	else{
		header("location: Admin_login.php");
	}
	//Checking whether the username does exist or not which is available in the function.php. 
	$usernameexist = usernameexist($connected, $username);
//user id check if exist or not
	if ($usernameexist == false) {
		header("location: Admin_login.php?error=usernameexist");
 		exit();
	}
	//Username's password is hashed in password. 
	$hashedpassword = $usernameexist["password"]; 
	//geting the hashed password frome database and matching with the given password
	//Password_verify is built in function. 
	$checkpassword = password_verify($password, $hashedpassword);

	if ($checkpassword == false) {
		header("location: Admin_login.php?error=wrongpassword");
 		exit();
	}
	//After matching everything, session is started 
	//After successful log in, the username is set on the variable. 
	else if ($checkpassword == true) {
		session_start();
		$_SESSION['username'] = $username; //saving the uername in a Session variable 
		header("location: index.php");
 		exit();
	}