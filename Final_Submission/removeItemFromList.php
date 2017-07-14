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
        <title>Remove List Item</title>
    </head>
    <body>
<br><br><br><br><br>
        <div class="page">
            <?php
                include 'header.html';
                include 'footer.html';
                if(isset($_POST['noButton'])){
                    header('location: index.php');
                }
            ?>
            <center>
                <div id="removeItem">
                    <form action="removeItemFromList.php" method="post">
                        <table id="removeItemTable">
                            <tr>
                                <td>Item Number: <input type="text" name="itemNumber" id='itemNumber' class="remove" required></td>
                            </tr>
                             <tr>
                                <td>
                                    <!-- <input type="submit" name="resetButton" value="Reset" onclick="this.reset()">   -->
                                    <input type="submit" value="Reset" class='buttonOption' onclick="document.getElementById('itemNumber').value = '';">  
                                    <input type="submit" value="Delete" class='buttonOption' onclick="return confirm('Are you sure?')" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <?php
                    if (isset($_POST['itemNumber']) && !empty($_POST['itemNumber'])) {
                        require("databaseFunctions.php");
                        deleteItemSafe($_POST['itemNumber']);
                    }
                ?>
            </center>
        </div>
    </body>
</html>
<?php
}
?>
