<?php echo '<pre>';

$input = array_map('trim', file('../../input'));

$debug = [];

function testSlope($step = 1, $bottomStep = 1) {
    global $input, $debug;

    $index = $countTrees = 0;
    $repeat = 2;

    foreach ($input as $key => $row) {
        if ($rowToSkip = ($key % $bottomStep > 0)) {
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
    }

    return $countTrees;
}

// echo testSlope().PHP_EOL;
// echo testSlope(3).PHP_EOL;
// echo testSlope(5).PHP_EOL;
// echo testSlope(7).PHP_EOL;
// echo testSlope(1, 2).PHP_EOL;

echo (testSlope() * testSlope(3) * testSlope(5) * testSlope(7) * testSlope(1, 2)).str_repeat(PHP_EOL, 2);

print_r($debug);