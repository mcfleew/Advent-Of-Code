<?php

$input = "325489";

$map = [];

$lastCoordonnees = [0, 0];

for ($i = 1; $i <= $input; $i++) { 
    $map[$i] = $lastCoordonnees;
}

var_dump($map);