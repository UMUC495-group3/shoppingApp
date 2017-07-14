<!DOCTYPE html>
<?php session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} 
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link rel="stylesheet" type="text/css" href="reflexive_style.css">
        <link rel ="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<br><br><br><br><br><br><br>
        <div class="page">
            <?php
                include 'header.html';
                include 'footer.html';

                if(isset($_POST['submitButton'])){
                    header('location: index.php');
                }
            ?>
            <div id="addItem">
                <form action="insert.php" method="post">
                    <table id="addItemTable">
                        <tr>
                            <td>Item Name: <input type="text" name="ProductName" id="ProductName" class="add" required></td>
                        </tr>
                        <tr>
                            <td>Item Number: <input type="text" name="ProductID" id="ProductID" class="add" required></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="resetButton" value="Reset" class="buttonOption" onclick="document.getElementById('ProductName').value=''; document.getElementById('ProductID').value='';">
                            <input type="submit" name="submitButton" value="Submit" class="buttonOption"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
