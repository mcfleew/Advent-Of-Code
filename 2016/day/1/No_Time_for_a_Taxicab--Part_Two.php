<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(strstr(__FILE__, "--", true), ".php"), "r");

$input = fgets($handle);

function SetCoordX($lastCoordX = 0) {
    global $coordX, $coordY;
    
    if ($lastCoordX < $coordX) {
        for ($i = $lastCoordX; $i < $coordX; $i++) {
            AddLocation($i, $coordY);
        }
    } else if ($lastCoordX > $coordX) {
        for ($i = $lastCoordX; $i > $coordX; $i--) {
            AddLocation($i, $coordY);
        }
    }
}

function SetCoordY($lastCoordY = 0) {
    global $coordX, $coordY;
    
    if ($lastCoordY < $coordY) {
        for ($j = $lastCoordY; $j < $coordY; $j++) {
            AddLocation($coordX, $j);
        }
    } else if ($lastCoordY > $coordY) {
        for ($j = $lastCoordY; $j > $coordY; $j--) {
            AddLocation($coordX, $j);
        }
    }
}

function AddLocation($coordX, $coordY) {
    global $locations, $noLocation, $theLocation;
    
    $myLocation = $coordY . ":" . $coordX;
    //var_dump($myLocation);
    
    if ($noLocation && !in_array($myLocation, $locations)) {
        $locations[] = $myLocation;
    } else if ($noLocation) {
        $noLocation = FALSE;
        $theLocation = $myLocation;
        //var_dump($theLocation); exit;
    }
}

////////////////////////////////////////////////////////////////////////////////

$delimiter = ", ";
$directions = explode($delimiter, $input);

$sens = "N";
$coordX = 0;
$coordY = 0;

$noLocation = TRUE;
$theLocation = "";
$locations = array();

foreach($directions as $direction) {
    $lastCoordX = $coordX;
    $lastCoordY = $coordY;
    
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
    
    SetCoordX($lastCoordX);
    SetCoordY($lastCoordY);
    //var_dump($coordY . ":" . $coordX);
}

$coords = explode(":", $theLocation);
$theLocationX = $coords[1];
$theLocationY = $coords[0];
//var_dump($coords);
//var_dump($coordY . ":" . $coordX); exit;
echo (abs($coords[1]) + abs($coords[0])) . PHP_EOL; ?>

////////////////////////////////////////////////////////////////////////////////


How many blocks away is the first location you visit twice?

Your puzzle answer was 158.