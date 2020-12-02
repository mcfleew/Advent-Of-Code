<?php 

$input = array_map('trim', file('../../input'));

$passwordsValid = 0;

foreach($input as $row) {
    list($policy, $password) = explode(': ', $row);
    list($min, $max, $letter) = sscanf($policy, '%d-%d %s');

    $allCount = array_count_values(str_split($password));
    if (isset($allCount[$letter])) {
        $count = $countAll[$letter];

        if ($min <= $count && $count <= $max) {
            $passwordsValid++;
        }
    }
}

echo $passwordsValid;