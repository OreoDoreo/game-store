<?php 
	include "DB_connection.php";
	include "function.php";
	//insertion of an order but with the status "pending"
	//When we are doing order, that will be in pending section.
	// Using post method we are taking name, email address etc. 
if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$game = $_POST['game_id'];
		$price = $_POST['price'];
		// Information could be direct passed but created a statement instead so that database cant be damaged after DATABASE Injection. 
		// 
		$sql = "INSERT INTO orders (customer_name, customer_email, customer_phone, customer_address, game, order_date, total_price, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
		//statement connects the database. 
		// after that $sql, stmt are sent for prepare. 
		
		$stmt = mysqli_stmt_init($connected);
		// after doing that statement is connected with $sql sequence above, below. 
		//After connecting, it will wait for value.
		//If all the statement cant be extracted then order page redirect. 
		if (!mysqli_stmt_prepare($stmt, $sql)) { 
			header("location: order_form.php?error=stmtfailed01");
			exit();
		}
		//Using PHP's built in function took the current date. 
		$date = date("Y.m.d");
		$status = "pending";
		// The statement we created , now we are inserting the value. 

		mysqli_stmt_bind_param($stmt, "ssisssis",$name, $email, $phone, $address, $game, $date, $price, $status);
		
		mysqli_stmt_execute($stmt); // Statement is executed.
		mysqli_stmt_close($stmt); // Statement gets closed. 

		header("location: index.php");
		exit();
	}

	// Here the game id will be catched which came from order.php
	//confirming the pending ordrs
if (isset($_GET['id'])) {
	$id=$_GET['id'];
	$title = $_GET['title'];
	// The id we sent tjat was in pending, now we have made it confirm. 
	$sql = "UPDATE orders SET status = 'confirm' WHERE id = '$id';";
	$result = mysqli_query($connected, $sql);
	// After confirm order, totla sell will be increase to 1. 
	$sql1 = "UPDATE games SET total_sell = (total_sell + 1) WHERE title = '$title';";
	$result1 = mysqli_query($connected, $sql1);
	header("location: order.php");
	exit();
}


