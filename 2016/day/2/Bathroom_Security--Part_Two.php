<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(strstr(__FILE__, "--", true), ".php"), "r");

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
            case 1: TestDirections($direction, 1, 1, 3, 1); break;
            case 2: TestDirections($direction, 2, 3, 6, 2); break;
            case 3: TestDirections($direction, 1, 4, 7, 2); break;
            case 4: TestDirections($direction, 2, 2, 8, 3); break;
            case 5: TestDirections($direction, 5, 6, 5, 5); break;
            case 6: TestDirections($direction, 2, 7, "A", 5); break;
            case 7: TestDirections($direction, 3, 8, "B", 6); break;
            case 8: TestDirections($direction, 4, 9, "C", 7); break;
            case 9: TestDirections($direction, 9, 9, 9, 8); break;
            case "A": TestDirections($direction, 6, "B", "A", "A"); break;
            case "B": TestDirections($direction, 7, "C", "D", "A"); break;
            case "C": TestDirections($direction, 8, "C", "C", "B"); break;
            case "D": TestDirections($direction, "B", "D", "D", "D"); break;
        }
    }
    
    $code .= $lastNum;
}

echo $code; ?>

////////////////////////////////////////////////////////////////////////////////


Using the same instructions in your puzzle input, what is the correct bathroom code?

Your puzzle answer was 9365C.