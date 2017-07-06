<?php

/*
 * @title:      mainPHP.php
 * @author:     Jesse Cruse
 * @date:       25 June 2017
 * @purpose:    ShoppingApp algorithm class. Class methods collect MySQL data
 *              and generates/ouputs calculated content for the front-end
 */

include("dbConnect.php");
include("databaseFunctions.php");

Class ShoppingList {

    //Delcare PHP class variables
    private $itemIDs;   //list of all users item ID's.
    private $masterItemList; //List of items items :: returned    

    function __construct() {    //Constructor
        $this->itemIDs = getAllItemIDs(); //set itemID array on instantiation
        $this->masterItemList = getAllListItems(); //Fill item master list array
    }

    //Method to ensure a valid connection to the database can be established
    private function connected() {
        global $db;
        if ($db->connect_error) {
            return FALSE;
        }
        return TRUE;
    }

    //Prints the 10 most popular items
    public function itemPopularityDensity() {
        if (!$this->connected()) {
            exit("Database Connection Error.");
        } //Kill method if no access to database
        $occuranceCountArray = array(); //declare empty array for top 10 items list
        $popularItems = getPopularItems(); //retrieve master popular items list        
        for ($i = 0; $i < 10; $i++) { //loop through master items array selecting only the top 10
            array_push($occuranceCountArray, $popularItems[$i][1]);
        }
        //Create output table structure
        echo "<br /><br /><br />";
        echo "<table style=width:25% border='1'>"
        . "<tr><th>Popularity Rank</th>"
        . "<th>Item</th>"
        . "</tr>";
        //Loop and print out table rows for each of the top ten items
        foreach ($occuranceCountArray as $key => $value) {
            echo "<tr><td>" . ($key + 1) . "</td><td>" . $value . "</td></tr>";
        }
        echo "</table>";
    }

    //Prints a list of purchases from the last five shopping trips
    public function recentShoppingTrips() {
        if (!$this->connected()) {
            exit("Database Connection Error.");            
        } //Kill method if no access to database
        $recentPurchases = getRecentTrips(); //retrieve a list of the recent purchases
        foreach ($recentPurchases as $key => $value) {
            $date = new DateTime($value[1]);
            echo "<p><h3>" . $date->format('l F j, Y') . "</h3></p>";
            for ($i = 0; $i < count($value[0]); $i++) {
                echo "<p>" . $value[0][$i][1] . "</p>";
            }
        }
    }

    /*  Method to test each item in array for eligibility to be added 
     *  and printed to the shopping list.  
     */
    public function generateList() {
        if (!$this->connected()) {
            exit("Database Connection Error.");
        } //Kill method if no access to database
        echo "<p><h2>Looks like you're due for these items:</h2></p>";
        echo "<form action='suggestedPurchases.php' method='POST'>";
        echo "<table style=width:50% border='1'><tr><th>Purchased?</th><th>Item ID</th><th>Item Description</th></tr>";
        foreach ($this->itemIDs as $itemID) {
            $itemPurchaseDateArray = getItemDates($itemID);            
            if ($this->eligible($itemPurchaseDateArray)) {
                echo "<tr><td align='center'><input type='checkbox' name='purchasedItem[]' value=$itemID></td><td>" . $itemID . "</td><td>" . $this->extractItemName($itemID) . "</td></tr>";
            }            
        }
        echo "</table>";
        echo "<input type='submit' value='Record Purchases'>";
        echo "</form>";
    }

    /*Method to determine eligibility to be added to current shopping list
    * 
    *	Adds item to recommended purchase list if the number of days that
    *	the item was last purchased is greater than the average purchase
    *	interval minus the standard deviation of the purchase interval.
    *	Subtracting a further five days helps to reduce shopping trip
    *	intervals by looking further into the future.
    */	
    private function eligible($purchaseDateArray) {
        if (count($purchaseDateArray) < 5) {
            return TRUE;
        }
        $dayIntervalArray = $this->getDayIntervalArray($purchaseDateArray);
        $averagePurchaseIntervalValue = $this->averagePurchaseInterval($dayIntervalArray);
        if (date_diff(date_create(date("Y-m-d")), date_create($purchaseDateArray[0]))->format('%a') 
                >= $averagePurchaseIntervalValue - $this->stats_standard_deviation($dayIntervalArray) - 5) {
            return TRUE;
        }
    }

    //Helper method to generate an array of differences between purchase dates
    private function getDayIntervalArray($dateArray) {
        $dayIntervalArray = array(); //initialize empty return array
        for ($i = 1; $i < count($dateArray); $i++) {
            $previousElement = $i - 1;
            //Calculate dat interval between dates
            $dayDifference = date_diff(date_create($dateArray[$previousElement]), 
                    date_create($dateArray[$i]))->format('%a');
            //Append the day interval between each two dates to the return array
            array_push($dayIntervalArray, $dayDifference);
        }
        return $dayIntervalArray;
    }

    //Helper method to determine the average purchase interval for an item
    private function averagePurchaseInterval($dayIntervalArray) {
        return array_sum($dayIntervalArray) / count($dayIntervalArray);
    }

    private function extractItemName($itemID) {
        foreach($this->masterItemList as $key => $nestedArray) {
            if($itemID == $nestedArray[0]) {
                return $nestedArray[1];
            }
        }
    }
    
    
    /* Method to compute and return the standard deviation of an input array
     * @source  http://php.net/manual/en/function.stats-standard-deviation.php
     */
    private function stats_standard_deviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        }
        if ($sample) {
            --$n;
        }
        return sqrt($carry / $n);
    }
}

//Testing purposes --> for page suggestedPurchases.php
//$obj = new ShoppingList();
//$obj->generateList();

//Testing purposes --> for page popularItems.php
//$obj = new ShoppingList();
//$obj->itemPopularityDensity();

//Testing purposes --> for page recentTrips.php
//$obj = new ShoppingList();
//$obj->recentShoppingTrips();
?>