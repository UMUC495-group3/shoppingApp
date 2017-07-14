<?php

function averageDateDifference($dateOne, $dateTwo) {
    return date_diff(date_create($dateOne), date_create($dateTwo));
}


    
?>
