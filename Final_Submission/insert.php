<?php
session_start();
require ('databaseFunctions.php');
$DB_HOST = "localhost";
$DB_USER = "umuccmsc_group3";
$DB_PASSWORD = "CMSC495?";
$DB_DATABASE = "umuccmsc_groupdb";

$db = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE) or die("Error connecting to database: " . mysqli_error());

$query = "INSERT INTO cmsc_products (ProductID, ProductName, UserID) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($db, $query);

mysqli_stmt_bind_param($stmt, 'isi', $_POST['ProductID'], $_POST['ProductName'], $_SESSION['UserID']);

if (mysqli_stmt_execute($stmt)) {
    echo '<script type="text/javascript">'; 
echo 'alert("Item inserted into shopping list");'; 
echo 'window.location.href = "http://umuccmsc495.x10host.com/addItemToList.php";';
echo '</script>';
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($db);
}

mysqli_stmt_close($stmt);
mysqli_close($db);
?>