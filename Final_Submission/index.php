<!DOCTYPE html>
<?php session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {

?>
<html>
    <head>
        <title>Predictive Shopping App</title>
        <script src="https://use.fontawesome.com/34053831d4.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link rel="stylesheet" type="text/css" href="reflexive_style.css">
        <link rel ="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="page">
            <?php
                include 'header.html';          
                include 'footer.html';
                /*If (user has shopping list){
                        Display shopping list as unsorted list links
                } else if {
                        No Shopping Lists
                } else {
                        Error Connecting to Database
                }*/
            ?>
            <div class="shoppingListOptions">
                <ul><br>
                    <li><a href="" 
  target="popup" 
  onclick="window.open('http://umuccmsc495.x10host.com/addItemToList.php','popup','width=600,height=600'); return false;"><button id="popup" onclick="div_show()">Add Products to Shopping List</button>
    </a></li>
<li><a href="" 
  target="popup" 
  onclick="window.open('http://umuccmsc495.x10host.com/removeItemFromList.php','popup','width=600,height=600'); return false;">
    <button id="popup" onclick="div_show()">Delete Products from Shopping List</button>
</a></li>
                </ul>
            </div>
        </div>
        <?php if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
        
             session_unset();     
             session_destroy();   

             header("Location: login.php");
         }
         $_SESSION['LAST_ACTIVITY'] = time(); 
         ?>
    </body>
</html>
<?php
}
?>