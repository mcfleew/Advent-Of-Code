<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

$input = fgets($handle);

////////////////////////////////////////////////////////////////////////////////

$delimiter = ", ";
$directions = explode($delimiter, $input);

$sens = "N";
$coordX = 0;
$coordY = 0;

foreach($directions as $direction) {
    $orientation = substr($direction, 0, 1);
    $avancement = substr(trim($direction), 1);
    
    if ("R" == $orientation) {
        switch ($sens) {
            case "N":
                $sens = "E";
                $coordX += $avancement;
                break;
            case "S":
                $sens = "O";
                $coordX -= $avancement;
                break;
            case "E":
                $sens = "S";
                $coordY -= $avancement;
                break;
            case "O":
                $sens = "N";
                $coordY += $avancement;
                break;
        }
    }
    if ("L" == $orientation) {
        switch ($sens) {
            case "N":
                $sens = "O";
                $coordX -= $avancement;
                break;
            case "S":
                $sens = "E";
                $coordX += $avancement;
                break;
            case "E":
                $sens = "N";
                $coordY += $avancement;
                break;
            case "O":
                $sens = "S";
                $coordY -= $avancement;
                break;
        }
    }
    
    //var_dump($coordY . ":" . $coordX);
}

echo (abs($coordX) + abs($coordY)) . PHP_EOL; ?>

////////////////////////////////////////////////////////////////////////////////


How many blocks away is Easter Bunny HQ?

Your puzzle answer was 298.