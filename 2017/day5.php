<?php

$input = include_once("day5_input.php");

$steps = explode("\n", $input);

$lastKey = $nextKey = 0;

$howManySteps = 0;

while (isset($steps[$nextKey])) {
    $nextKey = $lastKey + $steps[$lastKey];

    $steps[$lastKey] = $steps[$lastKey] + 1;

    $lastKey = $nextKey;
    
    $howManySteps++;
}

echo $howManySteps;