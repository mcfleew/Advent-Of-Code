<?php echo '<pre>';

include 'util.php';

$input = array_map('trim', file('../input'));

function checkSlope($rightStep = 1, $downStep = 1) {
    $colIndex = $countTrees = 0;
    $mapList = getMapList();

    foreach ($mapList as $rowIndex => $mapItem) {
        if (hasToSkipThisRow($rowIndex, $downStep)) {
            continue;
        }
        addDebugValue($rowIndex, $colIndex, $rightStep, $downStep);
        
        if ($colIndex >= getMapSize($mapItem)) {
            $mapItem = extendMap($mapItem);
        }
    
        if (isThereATree($mapItem, $colIndex)) {
            drawMapWith($rowIndex, $colIndex, TOKEN_IF_KO);
            $countTrees++;
        } else {
            drawMapWith($rowIndex, $colIndex, TOKEN_IF_OK);
        }

        $colIndex = getNextIndex($colIndex, $rightStep);
    }

    return $countTrees;
}

$debug = [];
$multiplier_repeat = 1;

// logDebug();

define('ROWS_TO_SHOW', count($input) - 1);
define('COLS_TO_SHOW', 1000);
define('TOKEN_IF_MEH', '.');
define('TOKEN_IF_OK', 'O');
define('TOKEN_IF_KO', 'X');

$slopes = [
    [1, 1],
    [3, 1],
    [5, 1],
    [7, 1],
    [1, 2],
];

$output = initOutput();
$result = getResult($slopes);

showResult($result);
showFullMap($output);