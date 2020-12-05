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

    foreach($characters as $key => $character) {
        if ($key < 7) {
            if ($character === 'F') $maxRow -= ($maxRow - $minRow + 1) / 2;
            if ($character === 'B') $minRow += ($maxRow - $minRow + 1) / 2;
        } else {
            if ($character === 'R') $maxCol -= ($maxCol - $minCol + 1) / 2;
            if ($character === 'L') $minCol += ($maxCol - $minCol + 1) / 2;
        }
    }

    $seatId = ($minRow * 8);
    $seatId += $minCol;
    $seatIds[] = $seatId;
}

sort($seatIds);

for ($mySeat = 0; $mySeat <= count($seatIds); $mySeat++) {
    if (!in_array($mySeat, $seatIds)) {
        if (in_array($mySeat-1, $seatIds) && in_array($mySeat+1, $seatIds)) {
            echo $mySeat; exit;
        }
    }
}