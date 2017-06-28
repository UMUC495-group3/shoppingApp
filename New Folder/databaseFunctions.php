<?php

/*
  databaseFunctions.php
  Tyler Roland
  6/2/17
  Possible functions to use when accessing the database

  Edited: 6/13/17
 */

//necessary if using SESSION variables to store user information (e.g. login)
session_start();

//show errors when they come up
error_reporting(E_ALL);

//database credentials
$DB_HOST = "localhost";
$DB_USER = "umuccmsc_group3";
$DB_PASSWORD = "CMSC495?";
$DB_DATABASE = "umuccmsc_groupdb";

//connect to database with credentials
$db = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE) or die("Error connecting to database: " . mysqli_error());


/* --- List of database tables / columns TO BE DELETED UPON RELEASE (ONLY FOR DEVELOPMENT) --- */

//cmsc_users
//UserID - Int (Primary, AI)
//Username - Varchar (50) (Unique)
//Email - Varchar (100) (Unique)
//Password - Varchar (50)
//cmsc_products
//ProductID - Int (Primary, AI)
//ProductName - Varchar (60)
//ProductPrice - Decimal
//Recurring - TinyInt (Boolean)
//cmsc_lists
//ListID - Int (Primary, AI)
//ProductID - Int (Foreign)
//ListDate - Date (in yyyy-mm-dd format!)
//CRUD = Create, Read, Update, Delete

/* -- Create / Insert -- */

function addItem($productname, $productprice, $recurring) {

    global $db;

    //inserting item into database
    $insertSQL = "INSERT INTO cmsc_items (ProductName, ProductPrice, Recurring) VALUES ('$productname', '$productprice', '$recurring')";
    $insertRESULT = mysqli_query($db, $insertSQL) or die("Error inserting item: " . mysqli_error($db));
}

function addItemSafe($productname, $productprice, $recurring) {

    global $db;

    //insert item into database, prepared (SAFER against malicious input)
    $stmt = $db->prepare("INSERT INTO cmsc_items (ProductName, ProductPrice, Recurring) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $productname, $productprice, $recurring);
    $stmt->execute();
    $stmt->close();
}

/* -- ---------------------------------------------- -- */

/* -- Read / Select -- */

//SELECT returns an array of rows from the specified tables (assuming chosen criteria are correct and match existing objects)

function getAllItems() { //gets all items from cmsc_products
    global $db;
    $returnArray = array(); //item of objects to be returned
    //select all items from the database to give user options
    $optionsSQL = "SELECT ProductID FROM cmsc_products";
    $optionsRESULT = mysqli_query($db, $optionsSQL) or die("Error retrieving items: " . mysqli_error($db));
    //go through each item from the selection
    while ($item = mysqli_fetch_assoc($optionsRESULT)) {
        //echo $item['ProductID'] . "\n";
        $tempArray = array();
        array_push($tempArray, $item['ProductID']);
        $productname = $item['ProductName'];
        $productprice = $item['ProductPrice'];
        //$recurring = $item['Recurring'];
    }
    return $returnArray;
}

function getAllListItems() { //gets all items from csmc_lists

    global $db;

    $itemsSQL = "SELECT a.ProductID, a.ListDate, b.ProductName FROM cmsc_lists a, cmsc_products b WHERE a.ProductID=b.ProductID ORDER BY a.ListDate DESC";
    $itemsRES = mysqli_query($db, $itemsSQL) or die("Error looking up items: " . mysqli_error($db));
    $returnArray = array();
    while ($item = mysqli_fetch_assoc($itemsRES)) {
        $tempArray = array();
        array_push($tempArray, $item['ProductID'], $item['ProductName'], $item['ListDate']);
        array_push($returnArray, $tempArray);
        //perform desired actions here 
        //...
        //...
        //echo $item['ListDate'] . " - " . $item['ProductID'] . " - " . $item['ProductName'] . "<br>";
    }
    return $returnArray;
}

function getRecurringItems() {

    global $db;

    //select recurring items
    $recurringSQL = "SELECT * FROM cmsc_products WHERE Recurring='1'";
    $recurringRESULT = mysqli_query($db, $recurringSQL) or die("Error retrieving recurring items: " . mysqli_error($db));

    $recurringItems = array();

    //go through each recurring item
    while ($item = mysqli_fetch_assoc($recurringRESULT)) {

        //Generate temporary product array of recurring items
        $tempProductArray = array($item['ProductID'], $item['ProductName'], $item['ProductPrice']);

        //Add current product to existing array of returnable products
        array_push($recurringItems, $tempProductArray);

        //Delete existing temporary array after adding to returable array in preparation for next iteration
        unset($tempProductArray);
    }

    //return array of recurring products
    return $recurringItems;
}

function getItemDates($productID) {

    global $db;

    //Array of product purchase dates
    $productDatesArray = array();

    //select all dates for a recurring item
    $datesSQL = "SELECT ListDate FROM cmsc_lists WHERE ProductID='$productID' ORDER BY ListDate DESC";
    $datesRESULT = mysqli_query($db, $datesSQL) or die("Error retrieving dates: " . mysqli_error($db));

    //go through each date purchased for this item
    while ($item = mysqli_fetch_assoc($datesRESULT)) {

        //temporary product date array - per date entry
        array_push($productDatesArray, $item['ListDate']);
    }

    return $productDatesArray;
}

function getAllItemIDs() { //gets all items from cmsc_products
    global $db;
    $returnArray = array(); //item of objects to be returned
    //select all items from the database to give user options
    $optionsSQL = "SELECT ProductID FROM cmsc_products";
    $optionsRESULT = mysqli_query($db, $optionsSQL) or die("Error retrieving items: " . mysqli_error($db));
    //go through each item from the selection
    while ($item = mysqli_fetch_assoc($optionsRESULT)) {
        //echo $item['ProductID'] . "\n";
        array_push($returnArray, $item['ProductID']);
        //$productname = $item['ProductName'];
        //$productprice = $item['ProductPrice'];
        //$recurring = $item['Recurring'];
    }
    return $returnArray;
}

function getRecentTrips() {

    global $db;

    //get up to last 5 shopping trips
    $datesSQL = "SELECT DISTINCT(ListDate) from cmsc_lists ORDER BY ListDate DESC LIMIT 5";
    $datesRES = mysqli_query($db, $datesSQL) or die("Error getting distinct dates: " . mysqli_error($db));

    $recentTrips = array();

    //go through each date and get all items bought on that date.
    while ($date = mysqli_fetch_assoc($datesRES)) {

        $itemsSQL = "SELECT b.ProductID, a.ProductName FROM cmsc_products a, cmsc_lists b WHERE a.ProductID=b.ProductID AND b.ListDate='" . $date['ListDate'] . "'";
        $itemsRES = mysqli_query($db, $itemsSQL) or die("Error getting item information: " . mysqli_error($db));

        $items = array();

        //add item and productID to the items array
        while ($item = mysqli_fetch_assoc($itemsRES)) {

            $arr = array($item['ProductID'], $item['ProductName']);
            array_push($items, $arr);
        }

        //create a temporary array with items array and date of those purchases
        $temp = array($items, $date['ListDate']);

        //add that day's items to the overall array
        array_push($recentTrips, $temp);
    }

    return $recentTrips;
}

function getPopularItems() {

    global $db;

    //get each ProductID from the lists table
    $itemSQL = "SELECT DISTINCT(ProductID) FROM cmsc_lists";
    $itemRES = mysqli_query($db, $itemSQL) or die("Error getting distinct items: " . mysqli_error($db));

    $itemOccurences = array();

    //go through each ProductID to get the number of times it exists (AKA number of times this item was bought)
    while ($item = mysqli_fetch_assoc($itemRES)) {

        $countSQL = "SELECT COUNT(a.ListDate) AS NumTimesBought, b.ProductName FROM cmsc_lists a, cmsc_products b WHERE a.ProductID = b.ProductID AND a.ProductID='" . $item['ProductID'] . "'";
        $countRES = mysqli_query($db, $countSQL) or die("Error getting count of distinct items: " . mysqli_error($db));

        $count = mysqli_fetch_assoc($countRES);

        //temp array with ID, Name, and number of times bought
        $arr = array($item['ProductID'], $count['ProductName'], $count['NumTimesBought']);

        //add the item information to the overall array
        array_push($itemOccurences, $arr);
    }

    //sort $itemOccurences array by NumTimesBought descending (if editing array, make sure to update NumTimesBought index here)
    usort($itemOccurences, function($a, $b) {
        return $a[2] < $b[2];
    });

    return $itemOccurences;
}

/* -- ---------------------------------------------- -- */

/* -- Update -- */

function updateRecurrence($recurring, $productID) {

    global $db;

    //update a recurring item
    $updateSQL = "UPDATE cmsc_items SET Recurring='$recurring' WHERE ProductID='$productID'"; //here, recurring would be either true or false (1 or 0)
    $updateRESULT = mysqli_query($db, $updateSQL) or die("Error updating product recurrence: " . mysqli_error($db));
}

function updateRecurrenceSafe($recurring, $productID) {

    global $db;

    //update a recurring item, prepared (SAFER against malicious input)
    $stmt = $db->prepare("UPDATE cmsc_items SET Recurring=? WHERE ProductID=?"); //here, recurring would be either true or false (1 or 0)
    $stmt->bind_param("ii", $recurring, $productID);
    $stmt->execute();
    $stmt->close();
}

function updatePrice($price, $productID) {

    global $db;

    //update the price of an item
    $updateSQL = "UPDATE cmsc_items SET ProductPrice='$price' WHERE ProductID='$productID'";
    $updateRESULT = mysqli_query($db, $updateSQL) or die("Error updating product price: " . mysqli_error($db));
}

function updatePriceSafe($price, $productID) {

    global $db;

    //update the price of an item, prepared (SAFER against malicious input)
    $stmt = $db->prepare("UPDATE cmsc_items SET ProductPrice=? WHERE ProductID=?");
    $stmt->bind_param("fi", $price, $productID);
    $stmt->execute();
    $stmt->close();
}

/* -- ---------------------------------------------- -- */

/* -- Delete -- */

function deleteItem($productID) {

    global $db;

    //delete an item from the database
    $deleteSQL = "DELETE FROM cmsc_items WHERE ProductID='$productID'";
    $deleteRESULT = mysqli_query($db, $deleteSQL) or die("Error deleting item: " . mysqli_error($db));
}

function deleteItemSafe($productID) {

    global $db;

    //delete an item from the lists table, prepared (SAFER against malicious input)
    $stmt = $db->prepare("DELETE FROM cmsc_lists WHERE ProductID=?");
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $stmt->close();
}

/* -- ---------------------------------------------- -- */

/* -- Login -- */

function tryLogIn($username, $password) {

    global $db;

    //select all instances of this username/password combination
    $stmt = $db->prepare("SELECT * FROM cmsc_users WHERE Username=? AND Password=?");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {

        $stmt->store_result();

        if ($stmt->num_rows() == 1) { //only 1 result was found, successfully logged in
            //A check should be added at the beginning every HTML/PHP user page for the app. 
            //If a user is not logged in, redirect them to the login page. 
            //e.g. if (!isset($_SESSION['login']) || !isset($_SESSION['username']) || $_SESSION['login'] != 1 || $_SESSION['username'] == '')
            $_SESSION['login'] = 1;
            $_SESSION['username'] = $username;

            //header("Location: home.php"); //This may need to change depending on how front-end is developed.
            header("Location: tylerLoginTest.php");
        } else { //invalid credentials
            echo "Incorrect username or password.";
        }
    }
    $stmt->close();
}

function logout() {
    if (isset($_SESSION['login']) && isset($_SESSION['username'])) {
        unset($_SESSION['login']);
        unset($_SESSION['username']);
        header("Location: login.php");
    }
}

?>