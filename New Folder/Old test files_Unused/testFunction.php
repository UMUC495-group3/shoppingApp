<?php

$testArr = array(1, 2, 3, 4, 5);
echo "test\r\n";
echo $testArr[0];
function testFunction($testArr) {
    echo "<br>";
    $otherArr = array();
    for ($i = 0; $i < sizeof($testArr); $i++) {
        array_push($otherArr, $testArr[$i]);
    }
    
    for ($j = 0; $j < sizeof($otherArr); $j++) {
        echo "<br>" . $otherArr[$j];
    }
}
testFunction($testArr);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$date1 = date_create("2017-03-31");
$date2 = date_create("2017-06-02");
$newDate = date_diff($date2, $date1);
echo "<br>" . $newDate->format('%a days');


?>