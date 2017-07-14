<?php

//Parse raw shopping list data from CSV file
$row = 0;
$newMap = new ArrayObject();
if (($handle = fopen("ShoppingItems.csv", "r")) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $newMap[0] = $data;
//        $num = count($data);
//        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
//        for ($c = 1; $c < $num; $c++) {
//            echo $data[$c] . "<br />\n";
//        }
    }
    fclose($handle);
}






    $serverName = "localhost";
    $userName = "umuccmsc_jcruse";
    $passWord = "j8r8c8c10";
    $dbname = "umuccmsc_groupdb";

    /*
     * Sample cmsc_products table column structure
     * 
     * ProductID    INT             AI
     * ProductName  varchar(60)
     * ProductPrice decimal(5,2)
     * Recurring    tinyint(1)
     * 
     */

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbname", $userName, $passWord);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    for ($i = 0; $i < sizeof($data); $i++) {
    $sql = "INSERT INTO cmsc_products (ProductName, ProductPrice, Recurring)
            VALUES ()";
    }
} catch (Exception $ex) {

}
?>