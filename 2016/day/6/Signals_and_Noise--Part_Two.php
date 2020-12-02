<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(strstr(__FILE__, "--", true), ".php"), "r");

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
    $minValue = -1;
    $myLetter = "";
    foreach($combinations[$i] as $key => $value) {
        if ($value < $minValue || $minValue == -1) {
            $minValue = $value;
            $myLetter = $key;
        }
    }
    echo $myLetter;
} ?>

////////////////////////////////////////////////////////////////////////////////


Given the recording in your puzzle input and this new decoding methodology, what is the original message that Santa is trying to send?

Your puzzle answer was akothqli.