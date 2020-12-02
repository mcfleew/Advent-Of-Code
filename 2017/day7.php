<?php

$input = include_once("day7_input.php");

$programs = explode("\n", $input);

$names = [];

$routes = [];


foreach ($programs as $program) {
    $functionCall = explode("->", $program);
    list($name, $intChelou) = explode(" ", $functionCall[0]);

    $routes[$name] = [];

    if (isset($functionCall[1])) {
        $parameters = explode(", ", trim($functionCall[1]));

        foreach($parameters as $parameter) {
            $routes[$name][$parameter] = [];
        }
    }
}



$finalArr = [];


foreach ($programs as $program) {
    $functionCall = explode("->", $program);
    list($name, $intChelou) = explode(" ", $functionCall[0]);

    $routes[$name] = [];

    if (isset($functionCall[1])) {
        $parameters = explode(", ", trim($functionCall[1]));

        foreach($parameters as $parameter) {
            $finalArr[$name][$parameter] = $routes[$parameter];
        }
    }
}

print_r($finalArr);