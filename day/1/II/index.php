<?php 

$input = file('../input');

$inputX = $inputY = $inputZ = array_map('intval', $input);

foreach($inputX as $x) {
    foreach($inputY as $y) {
        foreach($inputZ as $z) {
            $sum = $x + $y + $z;
            if ($sum === 2020) {
                echo ($x * $y * $z).PHP_EOL;
                exit;
            }
        }
    }
}