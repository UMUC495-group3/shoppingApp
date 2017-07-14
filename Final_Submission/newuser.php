<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="login_style.css">
		<style>
			body {
    			background-image: url("background2.jpg");
			}
		</style>
	</head>
	<body>  
		<div class="page">
		<center>
	
		<br><br><br><br><br><br><br>
		<div id="wrapper">
	                <div class="loginBox">
	                    <label id='appName'>New User Registry</label>
	                    <form action="login.php" method="post" align="center">
	                        <div id="userPassCont">
	                            <div id="userCont">
	                                <label for='username'>User Name:</label><br>
					<input type="text" name="username" required/><br>
	                            </div>
	                            <div id="passCont">
	                                <label for='password'>Password:</label><br>
					<input type="password" name="password" required/><br>
	                            </div>
	                            <div id="buttons">
	                                <button type="submit" style="margin-left: 110px;">Register</button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
            </div>
			<?php
				require ("databaseFunctions.php");

				if (isset($_POST['username']) && isset($_POST['password'])) {

					$username = $_POST['username'];
					$password = $_POST['password'];

					trySignUp($username, $password);
				}
			?>
		</center>
		</div>
	</body>
</html>