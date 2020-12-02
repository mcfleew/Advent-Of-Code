<?php

$input = "18,1,0,161,255,137,254,252,14,95,165,33,181,168,2,188";

$split = str_split($input);

$lengths = array_map("ord", $split);

array_push($lengths, 17, 31, 73, 47, 23);

$countValues = 255;

$values = range(0, $countValues);

$currentValueKey = 4;

$skipSize = 4;

for ($i=0; $i < 64; $i++) { 
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
        
        if ($skipSize > $countValues) {
            $skipSize = 0;
        } else {
            $skipSize++;
        }
    }
}

var_dump(array_diff(
    range(0, $countValues),
    $values
));

var_dump($values);