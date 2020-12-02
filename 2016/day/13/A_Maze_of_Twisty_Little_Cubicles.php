<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

$input = fgets($handle);

define("COORD_X", "31");
define("COORD_Y", "39");

function TestDirection($x, $y) {
    global $input;
    
    $number = pow($x, 2) + (3 * $x) + (2 * $x * $y) + $y + pow($y, 2);
    $number += $input;
    
    $binary_string = decbin($number);
    preg_match_all("/(1)/", $binary_string, $matches);
    
    if (!empty($matches[0])) {
        $bits_number = count($matches[0]);
        if ($bits_number % 2 == 0) {
            return $x.":".$y;
        }
    }
    return false;
}

function Test4Directions($x, $y) {
    $directions = array();
    
    if ($direction1 = TestDirection($x - 1, $y)) {
        $directions[] = $direction1;
    }
    if ($direction2 = TestDirection($x, $y - 1)) {
        $directions[] = $direction2;
    }
    if ($direction3 = TestDirection($x + 1, $y)) {
        $directions[] = $direction3;
    }
    if ($direction4 = TestDirection($x, $y + 1)) {
        $directions[] = $direction4;
    }
    
    return $directions;
}

////////////////////////////////////////////////////////////////////////////////

$x = $y = 1;
while ($x != COORD_X && $y != COORD_Y) {
    $possible_directions = Test4Directions($x, $y);
}