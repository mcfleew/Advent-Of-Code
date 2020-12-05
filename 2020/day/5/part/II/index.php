<?php echo '<pre>';

$input = array_map('trim', file('../../input'));
$boardingPasses = $input;

$seatIds = [];

foreach($boardingPasses as $boardingPass) {
    $characters = str_split($boardingPass);

    $minRow = 0;
    $maxRow = 127;

    $minCol = 0;
    $maxCol = 7;

    // echo $boardingPass.PHP_EOL;
    foreach($characters as $key => $character) {
        if ($key < 7) {
            // echo 'MinRow : '.$minRow.'; MaxRow : '.$maxRow.';'.PHP_EOL;
            if ($character === 'F') $maxRow -= ($maxRow - $minRow + 1) / 2;
            if ($character === 'B') $minRow += ($maxRow - $minRow + 1) / 2;
            // echo 'MinRow : '.$minRow.'; MaxRow : '.$maxRow.';'.PHP_EOL.PHP_EOL;
        } else {
            // echo 'MinCol : '.$minCol.'; MaxCol : '.$maxCol.';'.PHP_EOL;
            if ($character === 'R') $maxCol -= ($maxCol - $minCol + 1) / 2;
            if ($character === 'L') $minCol += ($maxCol - $minCol + 1) / 2;
            // echo 'MinCol : '.$minCol.'; MaxCol : '.$maxCol.';'.PHP_EOL.PHP_EOL;
        }
    }

    $seatId = ($minRow * 8);
    $seatId += $minCol;
    $seatIds[] = $seatId;
}

echo max($seatIds);