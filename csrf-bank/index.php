<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include 'Helper/session.php';
		if(isset($_SESSION["loggedId"]))
			header("Location:transfer.php");
	?>
	<h1>Login</h1>
	<form method="POST" action="Auth/doLogin.php">
		<input type="text" name="username">
		<input type="password" name="password">
		<input type="submit" value="Login">
	</form>
</body>
</html>