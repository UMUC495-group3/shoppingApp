<?php

/*
 * Title:   testSelectTabledata.php
 * Author:  Jesse Cruse
 * Date:    1 June 2017
 * Purpose: Test/Implement MySQL table data and algorithm functionality.
 */

require 'databaseFunctions.php';
require 'functions_PHP.php';

echo "Date diff = " . averageDateDifference("2017-03-15", "2013-12-12")->format('%a days') . "<br />";

$recurringItemsArray = getRecurringItems();
echo count($recurringItemsArray) . "<br />";
if(empty($recurringItemsArray)) {
    echo "No recurring products";
} else {
    for ($i = 0; $i < count($recurringItemsArray); $i++) {
        for ($j = 0; $j < count($recurringItemsArray[0]); $j++) {
            echo $recurringItemsArray[$i][$j] . " ";
        }
        echo "<br />";
    }
}

$arrayOFDates = getItemDates('5623');
echo "<br /><br />";
if (empty($arrayOFDates)) {
    echo "array of dates is empty";
} else {
    //Sort dates in ascending order
    usort($arrayOFDates, "date_sort");
    
    //Print each date out on a separate line
    foreach ($arrayOFDates as $value) {
        echo "$value <br />";
    }
}
echo "<br />";
for ($i = 1; $i < count($arrayOFDates); $i++) {
    $tempArrayElement = $i - 1;
//    $firstDate = create_date($arrayOFDates[$tempArrayElement]);
//    $secondDate = create_date($arrayOFDates[$i]);
//    $diff = date_diff($firstDate, $secondDate)->('%a days');
    echo "$arrayOFDates[$tempArrayElement] - $arrayOFDates[$i] = " . date_diff(date_create($arrayOFDates[$tempArrayElement]), date_create($arrayOFDates[$i]))->format('%a days') . "<br />";
}


//$serverName = "localhost";
//$userName = "umuccmsc_jcruse";
//$passWord = "j8r8c8c10";
//$dbname = "umuccmsc_groupdb";

//Create connection
//$conn = new mysqli($serverName, $userName, $passWord, $dbname);
//
////Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//
//$sql = "SELECT ProductID, ProductName, ProductPrice from cmsc_products WHERE Recurring=1";
//$result = $conn->query($sql);
//
//if ($result->num_rows > 0) {
//    echo "<table><tr><th>Product ID</th><th>Product Name</th><th>Product Price</th></tr>";
//    //output data of each row
//    while ($row = $result->fetch_assoc()) {
//        echo "<tr><td>" . $row["ProductID"] . "</td><td>" . $row["ProductName"] . "</td><td>" . $row["ProductPrice"] . "</td></tr>";
//    }
//    echo "</table>";
//} else {
//    echo "0 results";
//}
//$conn->close();
//try {
//    $conn = new PDO("mysql:host=$serverName;dbname=umuccmsc_groupdb", $userName, $passWord);
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $stmt = $conn->prepare("SELECT * FROM cmsc_products WHERE Recurring=0");
//    $stmt->execute();
//
//    //set the resulting array to associative
//    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//    foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
//        echo $v;
//    }
//} catch (PDOException $e) {
//    echo "Error: " . $e->getMessage();
//}
//
//$conn = null;
//echo "</table>";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>