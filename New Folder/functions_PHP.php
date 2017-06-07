<?php

function averageDateDifference($dateOne, $dateTwo) {
    $date1=date_create($dateOne);
$date2=date_create($dateTwo);
$diff=date_diff($date1,$date2);
return $diff;
}

?>