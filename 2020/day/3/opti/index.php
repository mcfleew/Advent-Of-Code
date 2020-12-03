<?php echo '<pre>';

$input = array_map('trim', file('../input'));

function hasToSkipThisRow($rowIndex, $downStep) {
    return ($rowIndex % $downStep > 0);
}

function getMapSize($mapString) {
    return strlen($mapString);
}

function extendMap($mapString) {
    global $multiplier_repeat;

    $multiplier_repeat++;
    return str_repeat($mapString, $multiplier_repeat);
}

function turnToArray($mapString) {
    return str_split($mapString);
}

function isThereATree($mapString, $colIndex) {
    // Turn row string into array
    $mapArray = turnToArray($mapString);
    return $mapArray[$colIndex] === '#';
}

function checkSlope($rightStep = 1, $downStep = 1) {
    global $input, $debug, $output;

    $colIndex = $countTrees = 0;
    $multiplier_repeat = 2;

    foreach ($input as $rowIndex => $mapString) {
        if (hasToSkipThisRow($rowIndex, $downStep)) {
            continue;
        }
        // $debug[intval($downStep).$rightStep][$rowIndex] = $colIndex;
        
        // Repeat map's pattern if index greater than map length
        if ($colIndex >= getMapSize($mapString)) {
            $mapString = extendMap($mapString);  // $colIndex -= count($map) - 1;
        }
    
        // Looking for trees depend of RightStep and DownStep defined by actual slope
        if (isThereATree($mapString, $colIndex)) {
            $output[$rowIndex][$colIndex] = TOKEN_IF_KO;
            $countTrees++;
        } else {
            $output[$rowIndex][$colIndex] = TOKEN_IF_OK;
        }
        $colIndex += $rightStep;
    }

    return $countTrees;
}

$debug = [];
$multiplier_repeat = 1;

// echo checkSlope().PHP_EOL;
// echo checkSlope(3).PHP_EOL;
// echo checkSlope(5).PHP_EOL;
// echo checkSlope(7).PHP_EOL;
// echo checkSlope(1, 2).PHP_EOL;

// print_r($debug);

define('ROWS_TO_SHOW', count($input) - 1);
define('COLS_TO_SHOW', 1000);
define('TOKEN_IF_MEH', '.');
define('TOKEN_IF_OK', 'O');
define('TOKEN_IF_KO', 'X');

$output = array_fill_keys(range(0, ROWS_TO_SHOW), array_fill_keys(range(0, COLS_TO_SHOW), TOKEN_IF_MEH));

echo (checkSlope() * checkSlope(3) * checkSlope(5) * checkSlope(7) * checkSlope(1, 2)).str_repeat(PHP_EOL, 2);

// Show full map
$rowId = 0;
array_map(function ($fullMap) {
    global $rowId;
    echo $rowId.' : '.implode('', $fullMap).PHP_EOL;
    $rowId++;
}, $output);