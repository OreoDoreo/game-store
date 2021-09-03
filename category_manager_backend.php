<?php 
	include "DB_connection.php";
	include "function.php";
	//category deletion
	//When we press the delete button in the category manager, [Passing the category id value]
	//checks whether the action is delete or not. 
	//If i delete a category, the games that falls under it also get deleted. 
	
	if ($_GET['action']=="delete") {
		$deleteid = $_GET['id'];
		$delettitle = $_GET['title'];
		$sql="DELETE FROM category WHERE id = '$deleteid';";
		$result = mysqli_query($connected, $sql);
		//Thats why checking which games falling under this category. 
        $sql2="DELETE FROM games WHERE category = '$delettitle';";
		$result2 = mysqli_query($connected, $sql2);
		header("location: category_manager.php");
		exit();
	}

	//category insertion
	if (isset($_POST['add'])) {
		$title = $_POST['title'];
		$active = $_POST['active'];
		$featured = $_POST['featured'];
		// taking the image name  
		$image = $_FILES['image']['name'];
		// created statement. 
		// Statement are created only for database so that unwanted data are not saved in database. 
		$sql="INSERT INTO category( title, image, active, featured) VALUES (?,?,?,?)";
			$stmt = mysqli_stmt_init($connected);
			if (!mysqli_stmt_prepare($stmt, $sql)) { 
				header("location: category_manager.php?error=stmtfailedcategoryadd");

				exit();
			}
			//Value's are getting added here. 
			mysqli_stmt_bind_param($stmt, "ssss",$title, $image, $active, $featured); 
			mysqli_stmt_execute($stmt);
			//After executing the value, we are closing the statement and heading towardss the category manager. 
			mysqli_stmt_close($stmt);
			header("location: category_manager.php");
			exit();
	}

	//category update
	// At first checking whether the update button is pressed or not. 
	if (isset($_POST['update'])) {
		// At first checking whether the category has id not not. 
		if (isset($_POST['category_id'])) {
			// Storing the category in the $category_id variable. 
			$category_id = $_POST['category_id'];
			
				if (isset($_POST['title'])) { //category title update in the category table and aslo in the game table 
					$title = $_POST['title'];
					$sql = "UPDATE category SET title = '$title' WHERE id = '$category_id';";
					$result = mysqli_query($connected, $sql);
					$oldtitle = $_POST['oldtitle'];
					//As the category title is changed, so game title must also be changed. 
					$sql2 = "UPDATE games SET category = '$title' WHERE category = '$oldtitle';";
					$result2 = mysqli_query($connected, $sql2);
				}
				
				if (isset($_FILES['image'])) { //category image update
					$image = $_FILES['image']['name'];
					$sql = "UPDATE category SET image = '$image' WHERE id = '$category_id';";
					$result = mysqli_query($connected, $sql);
				}
				if (isset($_POST['active'])) { //category activation update
					$active = $_POST['active'];
					$sql = "UPDATE category SET active = '$active' WHERE id = '$category_id';";
					$result = mysqli_query($connected, $sql);
				}

				if (isset($_POST['featured'])) { //category featured update
					$featured = $_POST['featured'];
					$sql = "UPDATE category SET  featured = '$featured' WHERE id = '$category_id';";
					$result = mysqli_query($connected, $sql);
				}
				header("location: category_manager.php");
				exit();
			
		}
		else{
			header("location: category_manager.php?error=categoryidnotgiven");
			exit();
		}
	}