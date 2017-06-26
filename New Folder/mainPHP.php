<?php

/*
 * Title:   mainPHP.php
 * Author:  Jesse Cruse
 * Date:    20 June 2017
 * Purpose: ShoppingApp algorithm class.
 */

include("dbConnect.php");
include("databaseFunctions.php");

Class ShoppingList {

    //Delcare PHP class variables
    private $itemIDs;   //list of all users item ID's.
    public $returnShoppingList; //List of items items :: returned    

    function __construct() {    //Constructor
        $this->setItemIDArray(); //set itemID array on instantiation
        $this->returnShoppingList = array();
    }

    //Method to ensure a valid connection to the database is established
    private function connected() {
        $connection = new mysqli($this->serverName, $this->userName, $this->PASSWORD);
        if ($connection->connect_error) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //Prints the most popular items
    function itemPopularityDensity() {
        $occuranceCountArray = array(); //instantiate blank array for top 10 items list
        $popularItems = getPopularItems(); //retrieve master popular items list        
        for ($i = 0; $i < 10; $i++) { //loop through master items array selecting only the top 10
            array_push($occuranceCountArray, $popularItems[$i][1]);
        }
        //Create output table structure
        echo "<table style=width:25%>"
        . "<tr>"
        . "<th>Popularity Rank</th>"
        . "<th>Item</th>"
        . "</tr>";
        //Loop and print out table rows for each of the top ten items
        foreach ($occuranceCountArray as $key => $value) {
            echo "<tr><td>" . ($key + 1) . "</td><td>" . $value . "</td></tr>";
        }
        echo "</table>";
    }

    function setItemIDArray() {
        $this->itemIDs = $this->getAllItemIDs();
    }

    //Prints a list of recent purchases
    function recentPurchases() {
        $recentPurchases = getRecentTrips(); //retrieve a list of the recent purchases
        //Create output table structure
        echo "<table style=width:25%>"
        . "<tr>"
        . "<th>Pop</th>"
        . "<th>Item</th>"
        . "</tr>";
        foreach ($recentPurchases as $key => $value) {
            //echo "<tr><td>" . ($key+1) . "</td><td>" . print_r($value) . "</td></tr><br />";
            print_r($value);
        }
    }

    //Helper method to build array of dates for each item in the users database
    private function getPurchaseDateArray($itemID) {
        $outputArray = array();
    }

    function getAllItemIDs() {
        return getAllListItems();
    }

}

$obj = new ShoppingList();
$array = $obj->getAllItemIDs();
foreach ($array as $innerArray) {
    echo $innerArray[2] . "<br />";
}
?>