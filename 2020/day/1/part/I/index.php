<?php echo '<pre>';

$input = array_map('trim', file('../../input'));

$inputX = $inputY = array_map('intval', $input);

foreach($inputX as $x) {
    foreach($inputY as $y) {
        $sum = $x + $y;
        if ($sum === 2020) {
            echo ($x * $y).PHP_EOL;
            exit;
        }
    }
}