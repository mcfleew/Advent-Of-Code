<?php echo '<pre>';

$input = array_map('trim', file('../../input'));

$index = $countTrees = 0;
$repeat = 2;

foreach ($input as $row) {
    if ($index >= strlen($row)) {
        $row = str_repeat($row, $repeat); // $index -= count($map) - 1;
        $repeat++;
    }

    $map = str_split($row);

    if ($map[$index] === '#') {
        $countTrees++;
    }
    $index += 3;
}

echo $countTrees;