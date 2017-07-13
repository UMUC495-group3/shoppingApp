<?php

/*
  databaseFunctions.php
  Tyler Roland
  7/2/17
  Possible functions to use when accessing the database
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

//global UserID variable
if (isset($_SESSION['UserID'])) 
    $userID = $_SESSION['UserID'];



/* -- Create / Insert -- */

function addItem($productname, $productprice) {

    global $db;
    global $userID;

    //inserting item into database
    $insertSQL = "INSERT INTO cmsc_items (ProductName, ProductPrice, UserID) VALUES ('$productname', '$productprice', '$userID')";
    $insertRESULT = mysqli_query($db, $insertSQL) or die("Error inserting item into products table: " . mysqli_error($db));
}

function addItemSafe($productname, $productprice) {

    global $db;
    global $userID;

    //insert item into database, prepared (SAFER against malicious input)
    $stmt = $db->prepare("INSERT INTO cmsc_items (ProductName, ProductPrice, UserID) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $productname, $productprice, $userID);
    $stmt->execute();
    $stmt->close();
}

function addListItem($productID, $listDate) {

	global $db;
	global $userID;

	//Insert item to database
	$insertSQL = "INSERT INTO cmsc_lists (ProductID, UserID, ListDate) VALUES ('$productID', '$userID', '$listDate')";
	$insertRESULT = mysqli_query($db, $insertSQL) or die ("Error inserting item into lists table: " . mysqli_error($db));
}

function addListItemSafe($productID, $listDate) {

	global $db;
	global $userID;

	//insert item into database, prepared (SAFER against malicious input)
	$stmt = $db->prepare("INSERT INTO cmsc_lists (ProductID, UserID, ListDate) VALUES (?, ?, ?)");
	$stmt->bind_param("iis", $productID, $userID, $listDate);
	$stmt->execute();
	$stmt->close();
}

/* -- ---------------------------------------------- -- */

/* -- Read / Select -- */

function getAllItems() { //gets all items from cmsc_products
    
    global $db;
    global $userID;
    
    $returnArray = array(); //item of objects to be returned
    
    //select all items from the database to give user options
    $optionsSQL = "SELECT ProductID, ProductName FROM cmsc_products";
    $optionsRESULT = mysqli_query($db, $optionsSQL) or die("Error retrieving items: " . mysqli_error($db));
    
    //go through each item from the selection
    //while ($item = mysqli_fetch_assoc($optionsRESULT)) {
    while ($item = mysqli_fetch_array($optionsRESULT, MYSQLI_NUM)) {
        //echo $item['ProductID'] . "\n";
        //$tempArray = array();
        //array_push($tempArray, $item['ProductID']);
        array_push($returnArray, $item);
    }
    return $returnArray;
}

function getAllListItems() { //gets all items from csmc_lists

    global $db;
    global $userID;

    $returnArray = array();

    $itemsSQL = "SELECT a.ProductID, a.ListDate, b.ProductName FROM cmsc_lists a, cmsc_products b WHERE a.ProductID=b.ProductID ORDER BY a.ListDate DESC";
    $itemsRES = mysqli_query($db, $itemsSQL) or die("Error looking up items: " . mysqli_error($db));
    
    while ($item = mysqli_fetch_assoc($itemsRES)) {
        $tempArray = array();
        array_push($tempArray, $item['ProductID'], $item['ProductName'], $item['ListDate']);
        array_push($returnArray, $tempArray);
    }
    return $returnArray;
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
    global $userID;
    
    $returnArray = array(); //item of objects to be returned
    
    //select all items from the database to give user options
    $optionsSQL = "SELECT ProductID FROM cmsc_products WHERE UserID='$userID'";
    $optionsRESULT = mysqli_query($db, $optionsSQL) or die("Error retrieving items: " . mysqli_error($db));
    
    //go through each item from the selection
    while ($item = mysqli_fetch_assoc($optionsRESULT)) {
        //echo $item['ProductID'] . "\n";
        array_push($returnArray, $item['ProductID']);
    }
    return $returnArray;
}

function getRecentTrips() {

    global $db;
    global $userID;

    //get up to last 5 shopping trips
    $datesSQL = "SELECT DISTINCT(ListDate) from cmsc_lists WHERE UserID='$userID' ORDER BY ListDate DESC LIMIT 5";
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
    global $userID;

    //get each ProductID from the lists table
    $itemSQL = "SELECT DISTINCT(ProductID) FROM cmsc_lists WHERE UserID='$userID'";
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
    $stmt = $db->prepare("SELECT UserID FROM cmsc_users WHERE Username=? AND Password=?");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {

        $stmt->store_result();
        $stmt->bind_result($userID);

        //only 1 result was found, successfully logged in
        if ($stmt->num_rows() == 1) { 
            
            $stmt->fetch();
            
            $_SESSION['login'] = 1;
            $_SESSION['username'] = $username;
            $_SESSION['UserID'] = $userID;

            header("Location: index.php");

        } else { //invalid credentials
            echo "Incorrect username or password.";
        }
    }
    $stmt->close();
}


function trySignUp($username, $password) {
    
    global $db;

    $stmt = $db->prepare("SELECT UserID FROM cmsc_users WHERE Username=?");
    $stmt->bind_param("s", $username);
    if ($stmt->execute()) {

        $stmt->store_result();

        //no users found with this username. Create new user
        if ($stmt->num_rows() == 0) {
            $insertStmt = $db->prepare("INSERT INTO cmsc_users (Username, Password) VALUES (?,?)");
            $insertStmt->bind_param("ss", $username, $password);
            if ($insertStmt->execute()) {

                //log in the new user.
                tryLogIn($username, $password);
            }
        }

        else {
            echo "This username has already been taken. Please try another username.";
        }

    }
    $stmt->close();
}

function logout() {
    if (isset($_SESSION['login']))		unset($_SESSION['login']);
    if (isset($_SESSION['username']))	unset($_SESSION['username']);
    if (isset($_SESSION['UserID']))		unset($_SESSION['UserID']);

    header("Location: login.php");
}

?>