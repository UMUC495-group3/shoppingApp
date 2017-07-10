<?php

/*
 * This file tests the connection to the server-side database.
 */

class DatabaseConnection {
        private $serverName = "localhost";
        var $userName = "umuccmsc_jcruse";
        var $passWord = "j8r8c8c10";
        
    function connected() {
        $connection = new mysqli($this->serverName, $this->userName, $this->passWord);
        if ($connection->connect_error) {
            return false;
        } else {
            return true;
        }
    }
}

// try {
// $connection = new PDO("mysql:host=$serverName;dbname=umuccmsc_groupdb", $userName, $passWord);
//   set the PDO error mode to exception
// $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully";
// } catch (PDOException $ex) {
// echo "Connection failed:" . $ex->getMessage();
// }
// $connection = null;
?>