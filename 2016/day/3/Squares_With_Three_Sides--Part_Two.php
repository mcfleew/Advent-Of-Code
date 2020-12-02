<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(strstr(__FILE__, "--", true), ".php"), "r");

////////////////////////////////////////////////////////////////////////////////

$triangles = array();

while (($buffer = fgets($handle)) !== false) {
    $valuesToFilter = explode(" ", $buffer);
    $valuesRaw = array_filter($valuesToFilter);
    $values = array_values($valuesRaw);
    
    for ($i = 0; $i <= 2; $i++) {
        $key = $i;
        $keyTr = 1;
        $value = $values[$key];
        $input = str_pad($value, 3, 0, STR_PAD_LEFT);
        $digit = "X"; //$digit = substr($input, 0, 1);
        if (isset($triangles[$key][$digit])) {
            $keyTr = count($triangles[$key][$digit]); 
            $nbTri = count($triangles[$key][$digit][$keyTr]);
            
            if ($nbTri > 2) {
                $keyTr++;
            }
        }
        $triangles[$key][$digit][$keyTr][] = $value;
    }
}

$count = 0;

foreach ($triangles as $col => $trianglesByCol) {
    foreach ($trianglesByCol as $digit => $trianglesByDigit) {
        foreach ($trianglesByDigit as $keyTr => $triangle) {
            if (count($triangle) == 3) {
                $values = array_values($triangle);
                $sum = array_sum($values);
                $valid = true;
                foreach ($values as $value) {
                    $remainingValue = intval($value);
                    $otherSidesValue = intval($sum - $value);
                    if ($remainingValue >= $otherSidesValue) {
                        $valid = false;
                        break;
                    }
                }

                if ($valid) {
                    $count++;
                }
            }
        }
    }
}

echo $count; ?>

////////////////////////////////////////////////////////////////////////////////


In your puzzle input, and instead reading by columns, how many of the listed triangles are possible?

Your puzzle answer was 1649.