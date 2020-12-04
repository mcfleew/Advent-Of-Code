<?php

function hasToSkipThisRow($rowIndex, $downStep) {
    return ($rowIndex % $downStep > 0);
}

function getMapSize($mapString) {
    return strlen($mapString);
}

function extendMap($mapString) {
    global $multiplier_repeat;

    $multiplier_repeat++;
    return str_repeat($mapString, $multiplier_repeat); // $colIndex -= count($map) - 1;
}

function turnToArray($mapString) {
    return str_split($mapString);
}

function isThereATree($mapString, $colIndex) {
    $mapArray = turnToArray($mapString);
    return $mapArray[$colIndex] === '#';
}

function drawMapWith($rowIndex, $colIndex, $token) {
    global $output;
    $output[$rowIndex][$colIndex] = $token;
}

function getNextIndex($colIndex, $rightStep) {
    return $colIndex += $rightStep;
}

function showFullMap($output) {
    $rowId = 0;
    array_map(function ($fullMap) {
        global $rowId;

        $id = ($rowId) ? $rowId : '0';
        echo $id.' : '.implode('', $fullMap).PHP_EOL;

        $rowId++;
    }, $output);
}

function showResult($result) {
    echo $result.str_repeat(PHP_EOL, 2);
}

function addDebugValue($rowIndex, $colIndex, $rightStep, $downStep) {
    global $debug;
    $debug[intval($downStep).$rightStep][$rowIndex] = $colIndex;
}

function logDebug() {
    global $debug;
    print_r($debug);
}

function initOutput() {
    return array_fill_keys(range(0, ROWS_TO_SHOW), array_fill_keys(range(0, COLS_TO_SHOW), TOKEN_IF_MEH));
}

function product($carry, $item)
{
    $carry *= $item;
    return $carry;
}

function multiplyAllSlopeTrees($nbTreesBySlope) {
    return array_reduce($nbTreesBySlope, "product", 1);
}

function getResult($slopes) {
    $nbTreesBySlope = [];

    foreach($slopes as $slope) {
        list($rightStep, $downStep) = $slope;
        $nbTreesBySlope[] = checkSlope($rightStep, $downStep);
    }
    return multiplyAllSlopeTrees($nbTreesBySlope);
}

function getMapList() {
    global $input; 
    return $input;
}