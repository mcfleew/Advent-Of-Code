<?php 

$input = array_map('trim', file('../../input'));

echo '<pre>';

$debug = [];

function testSlope($step = 1, $bottomStep = false) {
    global $input, $debug;

    $index = $countTrees = 0;
    $repeat = 2;
    $rowToSkip = false;

    foreach ($input as $key => $row) {
        if ($rowToSkip) {
            $rowToSkip = false;
            continue;
        }
        $debug[intval($bottomStep).$step][$key] = $index;
        
        if ($index >= strlen($row)) {
            $row = str_repeat($row, $repeat); // $index -= count($map) - 1;
            $repeat++;
        }
    
        $map = str_split($row);
    
        if ($map[$index] === '#') {
            $countTrees++;
        }
        $index += $step;

        if ($bottomStep) {
            $rowToSkip = true;
        }
    }

    return $countTrees;
}

echo testSlope().PHP_EOL;
echo testSlope(3).PHP_EOL;
echo testSlope(5).PHP_EOL;
echo testSlope(7).PHP_EOL;
echo testSlope(1, true).PHP_EOL;

echo (testSlope() * testSlope(3) * testSlope(5) * testSlope(7) * testSlope(1, true)).PHP_EOL;

print_r($debug);