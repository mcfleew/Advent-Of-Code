<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

function TestDirections($direction, $U, $R, $D, $L) {
    global $lastNum;
    
    switch($direction) {
        case "U":
            $lastNum = $U;
            break;
        case "R":
            $lastNum = $R;
            break;
        case "D":
            $lastNum = $D;
            break;
        case "L":
            $lastNum = $L;
            break;
    }
}

////////////////////////////////////////////////////////////////////////////////

$code = "";
$lastNum = 5;

while (($buffer = fgets($handle)) !== false) {
    $split = str_split($buffer);
    
    foreach($split as $direction) {
        switch ($lastNum) {
            case 1: TestDirections($direction, 1, 2, 4, 1); break;
            case 2: TestDirections($direction, 2, 3, 5, 1); break;
            case 3: TestDirections($direction, 3, 3, 6, 2); break;
            case 4: TestDirections($direction, 1, 5, 7, 4); break;
            case 5: TestDirections($direction, 2, 6, 8, 4); break;
            case 6: TestDirections($direction, 3, 6, 9, 5); break;
            case 7: TestDirections($direction, 4, 8, 7, 7); break;
            case 8: TestDirections($direction, 5, 9, 8, 7); break;
            case 9: TestDirections($direction, 6, 9, 9, 8); break;
        }
    }
    
    $code .= $lastNum;
}

echo $code; ?>

////////////////////////////////////////////////////////////////////////////////


What is the bathroom code?

Your puzzle answer was 35749.