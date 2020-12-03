<?php

$input = array_map('trim', file('../input'));

echo '<pre>';

function sum($carry, $item) {
    $carry += $item;
    return $carry;
}

function product($carry, $item) {
    $carry *= $item;
    return $carry;
}

function recursive ($entries, $items, $depth, $target) {
    foreach ($entries as $entry) {
        $index = abs(BOTTOM - $depth);
        $items[$index] = $entry;

        if ($depth > 1) {
            $previousItems = array_slice($items, 0, $index);

            if (array_reduce($previousItems, "sum", 0) > $target) {
                continue;
            } else if ($return = recursive($entries, $items, $depth - 1, $target)) {
                 return $return;
            }
        } else if (array_reduce($items, "sum", 0) == $target) {
            return array_reduce($items, "product", 1);
        }
    }
    return 0;
}

define('BOTTOM', 8);
define('GOAL', 2020);  

$values = array_map('intval', $input);

echo recursive($values, [], BOTTOM, GOAL);

// 1 : 0; 2 : 436404; 3 : 274879808; 4 : 11986029432; 5 : 1791116984592; 6 : 201919589675840; 7 : 8836503363440730;