<?php 
	include '../Connection/connect.php';
	session_start();

	//Get csrf_token from Form first
	$csrf_token = $_POST["csrf_token"];
	//Jika tidak ada token pada session , maka eksekusi code berakhir dan kembali ke halaman sebelumnya
	if(!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] == null){
		echo 'there is no csrf_token </br>';
		echo "<a href='../transfer.php'>Click here to back to transfer.php</a>";
		$_SESSION["csrf_token"] = null;
		
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		die();
	}
	if($csrf_token != $_SESSION['csrf_token']){
		echo 'token mismatch csrf_token </br>';
		echo "<a href='../transfer.php'>Click here to back to transfer.php</a>";
		$_SESSION["csrf_token"] = null;

		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		die();
	}
	//Setiap men-submit form, kita perlu menghapus session dari token lagi
	$_SESSION["csrf_token"] = null;


	//Setelah men-check csrf, barulah kita retrieve data dari form sebelumnya
	$to_username = $_POST["to_username"];
	$amount = $_POST["amount"];

	$result = $con->query("SELECT * FROM users WHERE username = '$to_username'");

	if( $result->num_rows == 0)
		header('Location:../transfer.php?msg=User tidak ketemu');
	else 
	{
		$to_id = "";
		if($row = $result->fetch_assoc())
		{
			$to_id = $row["id"];
		}

		$query = "UPDATE users SET money=money-".$amount." WHERE id=".$_SESSION["loggedId"]."";
		$result = $con->query($query);

		$query = "UPDATE users SET money=money+".$amount." WHERE id=".$to_id."";
		$result = $con->query($query);

		header("Location:../transfer.php");
	}


?>