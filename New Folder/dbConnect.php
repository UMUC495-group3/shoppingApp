<?php

/*
 * This file tests the connection to the server-side database.
 */

$serverName = "localhost";
$userName = "umuccmsc_jcruse";
$passWord = "j8r8c8c10";

try {
    $connection = new PDO("mysql:host=$serverName;dbname=umuccmsc_groupdb", $userName, $passWord);
    //set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $ex) {
    echo "Connection failed:" . $ex->getMessage();
}

$connection = null;
?>