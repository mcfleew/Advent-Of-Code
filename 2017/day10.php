<?php

$input = "18,1,0,161,255,137,254,252,14,95,165,33,181,168,2,188";

$lengths = explode(",", $input);

$countValues = 255;

$values = range(0, $countValues);

$currentValueKey = 0;

$skipSize = 0;

foreach ($lengths as $key => $length) {
    $nextValueKeyForecast = ($currentValueKey + $length - 1);

    if ($nextValueKeyForecast <= $countValues) {
        $myValuesRange = array_slice($values, $currentValueKey, $length);
    } else {
        $valuesRemainingLength1 = ($countValues - $currentValueKey + 1);
        $myValuesRange1 = array_slice($values, $currentValueKey, $valuesRemainingLength1);

        $valuesRemainingLength2 = $length - $valuesRemainingLength1;
        $myValuesRange2 = array_slice($values, 0, $valuesRemainingLength2);

        $myValuesRange = array_merge($myValuesRange1, $myValuesRange2);
    }
    $myValuesRangeReverse = array_reverse($myValuesRange);

    foreach ($myValuesRangeReverse as $myValue) {
        $values[$currentValueKey] = $myValue;
        $currentValueKey++;
        
        if ($currentValueKey > $countValues) {
            $currentValueKey = 0;
        }
    }

    $currentValueKey = $currentValueKey + $skipSize;
    
    $skipSize++;
}

var_dump(array_diff(
    range(0, $countValues),
    $values
));

var_dump($values);