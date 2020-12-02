<?php

$input = include_once("day2_input.php");

$rows = explode("\n", $input);

$numbersToSum = [];

foreach ($rows as $row) {
    $cols = array_map('intval', explode("\t", $row));

    $min = min($cols);
    $max = max($cols);

    $numbersToSum[] = ($max - $min);
}


echo array_sum($numbersToSum);