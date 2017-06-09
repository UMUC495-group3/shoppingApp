<?php

function averageDateDifference($dateOne, $dateTwo) {
    return date_diff(date_create($dateOne), date_create($dateTwo));
}

function date_sort($dateOne, $dateTwo) {
    if ($dateOne == $dateTwo) return 0;
    return ($dateOne>$dateTwo)?-1:1;
}
    
?>