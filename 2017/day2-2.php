<?php

$input = include_once("day2_input.php");

$rows = explode("\n", $input);

$numbersToSum = [];

foreach ($rows as $row) {
    $colsX = array_map('intval', explode("\t", $row));
    $colsY = array_map('intval', explode("\t", $row));
    
    foreach($colsX as $colX) {
        foreach($colsY as $colY) {
            $division = ($colX / $colY);

            if ($colX !== $colY && is_int($division)) {
                $numbersToSum[] = $division;
            }
        }
    }
}



echo array_sum($numbersToSum);