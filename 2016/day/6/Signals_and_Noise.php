<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

////////////////////////////////////////////////////////////////////////////////

$combinations = array();

while (($buffer = fgets($handle)) !== false) {
    $split = str_split($buffer);
    
    foreach ($split as $key => $value) {
        if (!isset($combinations[$key][$value])) {
            $combinations[$key][$value] = 0;
        } else {
            $combinations[$key][$value]++;
        }
    }
}

for ($i = 0; $i <= 7; $i++) {
    $maxValue = 0;
    $myLetter = "";
    foreach($combinations[$i] as $key => $value) {
        if ($value > $maxValue) {
            $maxValue = $value;
            $myLetter = $key;
        }
    }
    echo $myLetter;
} ?>

////////////////////////////////////////////////////////////////////////////////


Given the recording in your puzzle input, what is the error-corrected version of the message being sent?

Your puzzle answer was qtbjqiuq.