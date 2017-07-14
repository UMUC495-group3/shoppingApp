<html>
<head>
<title>Logout</title>
</head>

<?php
session_start();
unset($_SESSION['appusername']);
unset($_SESSION['appemail']);
echo $_POST["username"];
session_destroy();
header("Location: login.php");
?>    
</body>
</html>
