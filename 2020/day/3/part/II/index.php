<?php echo '<pre>';

$input = array_map('trim', file('../../input'));

function testSlope($step = 1, $bottomStep = 1) {
    global $input, $debug, $output;

    $index = $countTrees = 0;
    $repeat = 2;

    foreach ($input as $key => $row) {
        if ($rowToSkip = ($key % $bottomStep > 0)) {
            continue;
        }
        $output[$key][$index] = TOKEN_IF_OK;
        $debug[intval($bottomStep).$step][$key] = $index;
        
        if ($index >= strlen($row)) {
            $row = str_repeat($row, $repeat); // $index -= count($map) - 1;
            $repeat++;
        }
    
        $map = str_split($row);
    
        if ($map[$index] === '#') {
            $output[$key][$index] = TOKEN_IF_KO;
            $countTrees++;
        }
        $index += $step;
    }

    return $countTrees;
}

$debug = [];

// echo testSlope().PHP_EOL;
// echo testSlope(3).PHP_EOL;
// echo testSlope(5).PHP_EOL;
// echo testSlope(7).PHP_EOL;
// echo testSlope(1, 2).PHP_EOL;

// print_r($debug);

define('ROWS_TO_SHOW', count($input) - 1);
define('COLS_TO_SHOW', 1000);
define('TOKEN_IF_MEH', '.');
define('TOKEN_IF_OK', 'O');
define('TOKEN_IF_KO', 'X');

$output = array_fill_keys(range(0, ROWS_TO_SHOW), array_fill_keys(range(0, COLS_TO_SHOW), TOKEN_IF_MEH));

echo (testSlope() * testSlope(3) * testSlope(5) * testSlope(7) * testSlope(1, 2)).str_repeat(PHP_EOL, 2);

$i = 0;
array_map(function ($map) {
    global $i;
    echo $i.' : '.implode('', $map).PHP_EOL;
    $i++;
}, $output);