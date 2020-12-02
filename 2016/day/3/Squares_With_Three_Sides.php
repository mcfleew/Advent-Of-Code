<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

////////////////////////////////////////////////////////////////////////////////

$count = 0;

while (($buffer = fgets($handle)) !== false) {
    $valuesToFilter = explode(" ", $buffer);
    $valuesRaw = array_filter($valuesToFilter);
    
    $values = array_values($valuesRaw);
    $sum = array_sum($values);
    
    $valid = true;
    foreach ($values as $value) {
        if (($sum - $value) <= $value) {
            $valid = false;
            break;
        }
    }
    
    if ($valid) {
        $count++;
    }
}

echo $count; ?>

////////////////////////////////////////////////////////////////////////////////


In your puzzle input, how many of the listed triangles are possible?

Your puzzle answer was 917.