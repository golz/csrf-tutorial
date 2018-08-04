<?php
//Misalkan belum ada session 'csrf_token' maka kita buat baru csrf_tokennya, dimana
//csrf_token ini akan selalu direset ketika kita men-submit formnya
if(!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] == null || count($_SESSION['csrf_token']) == 0)
	$_SESSION["csrf_token"] = md5(rand());

