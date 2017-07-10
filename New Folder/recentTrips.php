<!DOCTYPE html>
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
        <title>Recent Trips</title>
    </head>
    <body>
        <div class="page">
            <?php
                include 'header.html';
                include ("mainPHP.php");
                
                //Instantiate algorithm object and call recent purchases method
                $obj = new ShoppingList();
                $obj->recentShoppingTrips();
                
                include 'footer.html';
                
                /*Connect to Database
                If (db exists) {
                        If (user has record of shopping trips) {
                                Output to screen recent shopping trip
                                Allow user to clink to view previous trips
                        } else if {
                                No trips
                        } else {
                                Error Message
                        }
                } else if (db does not exist) {
                        Error db does not exist;
                        Exit to Homepage;
                } else {
                        Error, Cannot connect to db;
   ?>
      
           }*/
          ?>
            <div class="shoppingListOptions">
                  <ul> <li><br><br><br><a href="" 
  target="popup" 
  onclick="window.open('http://umuccmsc495.x10host.com/07052017.php','popup','width=600,height=600'); return false;"><button id="popup" onclick="div_show()">07/05/2017</button>
    </a></li></ul><br>
<ul><li><a href="" 
  target="popup" 
  onclick="window.open('http://umuccmsc495.x10host.com/06302017.php','popup','width=600,height=600'); return false;"><button id="popup" onclick="div_show()">06/30/2017</button>
    </a></li></ul><br>
<ul><li><a href="" 
  target="popup" 
  onclick="window.open('http://umuccmsc495.x10host.com/06242017.php','popup','width=600,height=600'); return false;"><button id="popup" onclick="div_show()">06/24/2017</button>
    </a></li></ul><br>
<ul><li><a href="" 
  target="popup" 
  onclick="window.open('http://umuccmsc495.x10host.com/06182017.php','popup','width=600,height=600'); return false;"><button id="popup" onclick="div_show()">06/18/2017</button>
    </a></li></ul><br>
<ul><li><a href="" 
  target="popup" 
  onclick="window.open('http://umuccmsc495.x10host.com/06132017.php','popup','width=600,height=600'); return false;"><button id="popup" onclick="div_show()">06/13/2017</button>
    </a></li></ul><br>
                      
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