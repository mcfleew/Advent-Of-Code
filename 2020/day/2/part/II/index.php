<?php 

$input = array_map('trim', file('../../input'));

echo '<pre>';

$passwordsValid = 0;

foreach($input as $row) {
    list($policy, $password) = explode(': ', $row);
    list($min, $max, $letter) = sscanf($policy, '%d-%d %s');

    $allLetter = str_split($password);
    $minPos = $min - 1;
    $maxPos = $max - 1;

    if (in_array($letter, $allLetter)) {
        $findMinPos = isset($allLetter[$minPos]) ? ($allLetter[$minPos] == $letter) : false;
        $findMaxPos = isset($allLetter[$maxPos]) ? ($allLetter[$maxPos] == $letter) : false;

        if (($findMinPos || $findMaxPos) && !($findMinPos && $findMaxPos)) {
            $passwordsValid++;
        }
    }
}

echo $passwordsValid;