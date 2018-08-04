<?php 
	include '../Connection/connect.php';
	session_start();

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = $con->query("SELECT * FROM users WHERE username = '$username' AND password = '".md5($password)."' ");
	
	if( $result->num_rows == 0)
		header('Location:../index.php?msg=User tidak ketemu');
	else {
		header('Location:../transfer.php');
		while($row = $result->fetch_assoc()) {
			
			$_SESSION["loggedId"] = $row["id"];
		}
	}

?>