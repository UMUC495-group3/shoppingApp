<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/reflexive_style.css">
        <link rel ="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
        <title>Suggested Purchases</title>
    </head>
    <body>
        <div class="page">
            <?php
                include ("mainPHP.php");
                include 'header.html';
                
                //Instantiate algorithm object and call suggested purchases method
                $obj = new ShoppingList();
                $obj->generateList();
                
                $today = date("Y-m-d"); //create date object with todays date
                
				//Add details of checked items to database, including datestamp
                if(!empty($_POST['purchasedItem'])) { //interate through array of checked items
                    foreach($_POST['purchasedItem'] as $checked) {
                        addListItemSafe($checked, $today); //post details to database
                    }
                }
                
                

/*Connect to Database
                If (db exists) {
                        If (user == user in db) {
                                If (user has purchases) {
                                        If (purchase expiring) {
                                                Consider stocking up;
                                        }
                                        If (product == another product type) {
                                                You might be interested;
                                        }
                                } else {
                                        No purchases to display;
                                }
                        } else {
                                Error Message
                        }
                } else if (db does not exist) {
                        Error db does not exist;
                        Exit to Homepage;
                } else {
                        Error Cannot connect to db;
                }*/
                include 'footer.html';
            ?>
        </div>
        
    </body>
</html>
