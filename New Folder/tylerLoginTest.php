<?php
	session_start();

	if (!isset($_SESSION['login']) || !isset($_SESSION['username']) || $_SESSION['login'] != 1 || $_SESSION['username'] == '')
		echo "Not logged in.";
	else 
		echo "Logged in as: " . $_SESSION['username'];

?>