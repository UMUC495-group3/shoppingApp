<?php
	/*
		databaseFunctions.php
		Tyler Roland
		6/2/17
		Possible functions to use when accessing the database
	*/

	//show errors when they come up
	error_reporting(E_ALL); 

	//database credentials
	$DB_HOST = "localhost";
	$DB_USER = "umuccmsc_group3";
	$DB_PASSWORD = "CMSC495?";
	$DB_DATABASE = "umuccmsc_groupdb";

	//connect to database with credentials
	$db = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE) or die ("Error connecting to database: " . mysqli_error());




	//CRUD = Create, Read, Update, Delete

	/* -- Create / Insert -- */

	function addItem($productname, $productprice, $recurring) {

		global $db;
	
		//inserting item into database
		$insertSQL = "INSERT INTO cmsc_items (ProductName, ProductPrice, Recurring) VALUES ('$productname', '$productprice', '$recurring')";
		$insertRESULT = mysqli_query($db, $insertSQL) or die ("Error inserting item: " . mysqli_error($db));
	}

	function addItemSafe($productname, $productprice, $recurring) {

		global $db;

		//insert item into database, prepared (SAFER against malicious input)
		$stmt = $db->prepare("INSERT INTO cmsc_items (ProductName, ProductPrice, Recurring) VALUES (?, ?, ?)");
		$stmt->bind_param("ssi", $productname, $productprice, $recurring);
		$stmt->execute();
	}


	/* -- ---------------------------------------------- -- */

	/* -- Read / Select -- */

	//SELECT returns an array of rows from the specified tables (assuming chosen criteria are correct and match existing objects)

	function getAllItems() {

		global $db;

		//select all items from the database to give user options
		$optionsSQL = "SELECT * FROM cmsc_items";
		$optionsRESULT = mysqli_query($db, $optionsSQL) or die ("Error retrieving items: " . mysqli_error($db));

		//go through each item from the selection
		while ($item = mysqli_fetch_assoc($optionsRESULT)) {
			$productID = $item['ProductID'];
			$productname = $item['ProductName'];
			$productprice = $item['ProductPrice'];
			$recurring = $item['Recurring'];

			//perform desired actions here
			//...
			//...
		}
	}

	function getRecurringItems() {

		global $db;

		//select recurring items
		$recurringSQL = "SELECT * FROM cmsc_items WHERE Recurring='1'";
		$recurringRESULT = mysqli_query($db, $recurringSQL) or die ("Error retrieving recurring items: " . mysqli_error($db));

		//go through each recurring item
		while ($item = mysqli_fetch_assoc($recurringRESULT)) {
			$productID = $item['ProductID'];
			$productname = $item['ProductName'];
			$productprice = $item['ProductPrice'];
			$recurring = $item['Recurring'];

			//perform desired actions here
			//...
			//...
		}
	}

	function getItemDates($productID) {

		global $db;

		//select all dates for a recurring item
		$datesSQL = "SELECT ListDate FROM cmsc_lists WHERE ProductID='$productID'";
		$datesRESULT = mysqli_query($db, $datesSQL) or die ("Error retrieving dates: " . mysqli_error($db));

		//go through each date purchased for this item
		while ($item = mysqli_fetch_assoc($datesRESULT)) {
			$date = $item['ListDate'];

			//perform desired action here
			//...
			//...
		}
	}


	/* -- ---------------------------------------------- -- */

	/* -- Update -- */

	function updateRecurrence($recurring, $productID) {

		global $db;

		//update a recurring item
		$updateSQL = "UPDATE cmsc_items SET Recurring='$recurring' WHERE ProductID='$productID'"; //here, recurring would be either true or false (1 or 0)
		$updateRESULT = mysqli_query($db, $updateSQL) or die ("Error updating product recurrence: " . mysqli_error($db));
	}

	function updateRecurrenceSafe($recurring, $productID) {

		global $db;

		//update a recurring item, prepared (SAFER against malicious input)
		$stmt = $db->prepare("UPDATE cmsc_items SET Recurring=? WHERE ProductID=?"); //here, recurring would be either true or false (1 or 0)
		$stmt->bind_param("ii", $recurring, $productID);
		$stmt->execute();
	}

	function updatePrice($price, $productID) {

		global $db;

		//update the price of an item
		$updateSQL = "UPDATE cmsc_items SET ProductPrice='$price' WHERE ProductID='$productID'";
		$updateRESULT = mysqli_query($db, $updateSQL) or die ("Error updating product price: " . mysqli_error($db));
	}

	function updatePriceSafe($price, $productID) {

		global $db;

		//update the price of an item, prepared (SAFER against malicious input)
		$stmt = $db->prepare("UPDATE cmsc_items SET ProductPrice=? WHERE ProductID=?");
		$stmt->bind_param("fi", $price, $productID);
		$stmt->execute();
	}


	/* -- ---------------------------------------------- -- */

	/* -- Delete -- */

	function deleteItem($productID) {

		global $db;
		
		//delete an item from the database
		$deleteSQL = "DELETE FROM cmsc_items WHERE ProductID='$productID'";
		$deleteRESULT = mysqli_query($db, $deleteSQL) or die ("Error deleting item: " . mysqli_error($db));
	}

	function deleteItemSafe($productID) {

		global $db;
		
		//delete an item from the lists table, prepared (SAFER against malicious input)
		$stmt = $db->prepare("DELETE FROM cmsc_lists WHERE ProductID=?");
		$stmt->bind_param("i", $productID);
		$stmt->execute();
	}



?>
