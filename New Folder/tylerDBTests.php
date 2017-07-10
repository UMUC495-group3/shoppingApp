<?php
	session_start();
	require 'databaseFunctions.php';



	echo "<h2>Recent Trips function</h2>";

	$recentTrips = getRecentTrips();

	for ($x = 0; $x < count($recentTrips); $x++) {

		//show the date
		echo $recentTrips[$x][1] . "<br>---------------<br>";

		$items = $recentTrips[$x][0];

		//list each item purchased on that date with productID
		for ($y = 0; $y < count($items); $y++) {
		 	echo ($y+1) .": " . $items[$y][1] . " (" . $items[$y][0] . ")<br>";
		}

		echo "<br>";
	}





	echo "<h2>Popular Items</h2>";

	$occurences = getPopularItems();

	//show the top X most purchased products (e.g. top 10)
	for ($x = 0; $x < 10; $x++) {
		echo ($x+1) . ": " . $occurences[$x][1] . " (" . $occurences[$x][0] . ") <span style='font-size: 12px'>[Bought " . $occurences[$x][2] . " times]</span><br>";
	}




	// $username = "Tyler";
	// $password = "password";

	// tryLogin($username, $password);
?>