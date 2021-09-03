<?php 
	include "DB_connection.php";
	include "function.php";

//checking the inputs and save to variable-->
if (isset($_POST['signup'])) {
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$repeat_password = $_POST['repeat_password'];
	}

else{
	header("location: Admin_signup.php");
}


//checking passward error-->
 if (passwardMatch($password,$repeat_password) == false) {
 		header("location: Admin_signup.php?error=passwardMissMatch");
 		exit();
 }


//checking username exist or not error-->
 if (usernameexist($connected, $username) !== false) {

	// If username exist then it will go to username signup and show the error message
	// Whatever after ? is variable name and value is after the equal.  
 		header("location: Admin_signup.php?error=usernameexist");
 		exit();
 	 }


// statment preperation
$sql = "INSERT INTO admins (full_name,username, password) VALUES (?, ?, ?);";

$stmt = mysqli_stmt_init($connected);

if (!mysqli_stmt_prepare($stmt, $sql)) { 
	header("location: Admin_signup.php?error=stmtfailed02");

	exit();
}

$hashedpass = password_hash($password, PASSWORD_DEFAULT);
 
 //statment exicution
mysqli_stmt_bind_param($stmt, "sss",$fullname, $username, $hashedpass); 
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

session_start();
$_SESSION['username'] = $username;

header("location: Admin_manager.php");
exit();