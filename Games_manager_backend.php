<?php 
	include "DB_connection.php";
	include "function.php";
		//category deletion
	if ($_GET['action']=="delete") {
		$deleteid = $_GET['id'];
		$sql="DELETE FROM games WHERE id = '$deleteid';";
		$result = mysqli_query($connected, $sql);
		header("location: Games_manager.php");
		exit();
	}

	//category insertion
	if (isset($_POST['add'])) {
		$title = $_POST['title'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$active = $_POST['active'];
		$exclusive = $_POST['exclusive'];
		$image = $_FILES['image']['name'];
		$total_sell = 0;
		echo $category;

		//sending data using stetment
		$sql="INSERT INTO games( title, description, price, image, category, total_sell, active, exclusive) VALUES (?,?,?,?,?,?,?,?)";
			$stmt = mysqli_stmt_init($connected);
			if (!mysqli_stmt_prepare($stmt, $sql)) { 
				header("location: Games_manager.php?error=stmtfailedgamesadd");

				exit();
			}
			mysqli_stmt_bind_param($stmt, "ssississ",$title, $description, $price, $image, $category, $total_sell, $active, $exclusive); 
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			header("location: Games_manager.php");
			exit();
	}
	//category update
	if (isset($_POST['update'])) {

		if (isset($_POST['game_id'])) {
			$game_id = $_POST['game_id'];
			
				if (isset($_POST['title'])) {//game title update 
					$title = $_POST['title'];
					$sql = "UPDATE games SET title = '$title' WHERE id = '$game_id';";
					$result = mysqli_query($connected, $sql);
				}
				
				if (isset($_FILES['image'])) {//game image update
					$image = $_FILES['image']['name'];
					$sql = "UPDATE games SET image = '$image' WHERE id = '$game_id';";
					$result = mysqli_query($connected, $sql);
				}

				if (isset($_POST['description'])) {//game description update
					$description = $_POST['description'];
					$sql = "UPDATE games SET description = '$description' WHERE id = '$game_id';";
					$result = mysqli_query($connected, $sql);
				}

				if (isset($_POST['price'])) {//game price update 
					$price = $_POST['price'];
					$sql = "UPDATE games SET price = '$price' WHERE id = '$game_id';";
					$result = mysqli_query($connected, $sql);
				}

				if (isset($_POST['active'])) {//game activation update
					$active = $_POST['active'];
					$sql = "UPDATE games SET active = '$active' WHERE id = '$game_id';";
					$result = mysqli_query($connected, $sql);
				}

				if (isset($_POST['exclusive'])) {//game exclusive update 
					$exclusive = $_POST['exclusive'];
					$sql = "UPDATE games SET  exclusive = '$exclusive' WHERE id = '$game_id';";
					$result = mysqli_query($connected, $sql);
				}
				header("location: Games_manager.php");
				exit();
			
		}
		else{
			header("location: Games_manager.php?error=gameidnotgiven");
			exit();
		}
	}