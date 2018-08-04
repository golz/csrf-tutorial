<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include 'Helper/session.php';
		include 'Helper/csrf.php';

		include 'Connection/connect.php';
		
		$result = $con->query("SELECT * FROM users WHERE id = ".$_SESSION["loggedId"]);
		$row = $result->fetch_assoc();
		echo 'Username : ' . $row['username'] . '<br/>';
		echo 'Money : ' . $row['money'] . '<br/>';
		echo 'Token : ' . $_SESSION['csrf_token'];
	?>
	<form method="POST" action="Action/doTransfer.php">
		<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
		<input type="text" name="to_username" placeholder="To">
		<input type="number" name="amount" step="1000" min="0">
		<input type="submit" value="Transfer">
	</form>
	<a href="Auth/doLogout.php">Logout</a>
</body>
</html>