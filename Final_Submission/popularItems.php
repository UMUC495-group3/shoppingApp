<?php session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link rel="stylesheet" type="text/css" href="reflexive_style.css">
        <link rel ="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
        <title>Popular Items</title>
    </head>
    <body>
<br>
        <div class="page">
            <?php
                session_start();
                include 'header.html';
                echo "<div class='popularItems'>";
                	echo "<div class='algoCont'>";
                		include ("mainPHP.php");
                
                		//Instantiate algorithm object and call suggested purchases method
                		$obj = new ShoppingList();
                		$obj->itemPopularityDensity();
                	echo "</div>";
                echo "</div>";
                
                include 'footer.html';
                /*Connect to Database
                If (db exists) {
                        If (items in db == top 10 items) {
                            Output items to screen as list with potential to be added to list;
                        }
                } else if (db does not exist) {
                        Error db does not exist;
                        Exit to Homepage;
                } else {
                        Error Cannot connect to db;
                }*/
            ?>
        </div>
    </body>
</html>
<?php
}
?>