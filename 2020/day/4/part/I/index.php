<?php echo '<pre>';

$input = explode(str_repeat(PHP_EOL, 2), file_get_contents('../../input'));

$keys = array_flip([
    'byr', // (Birth Year)
    'iyr', // (Issue Year)
    'eyr', // (Expiration Year)
    'hgt', // (Height)
    'hcl', // (Hair Color)
    'ecl', // (Eye Color)
    'pid', // (Passport ID)
    'cid', // (Country ID)
]);

$passportValids = 0;

foreach($input as $passport) {
    $fields = preg_split('/\s|\n/', $passport);

    $newFields = [];
    foreach($fields as $field) {
        if ($field) {
            list($key, $value) = explode(':', $field);
            $newFields[$key] = $value;
        }
    }

    $diffKeys = array_diff_key($keys, $newFields);
    if (count($diffKeys) == 0) {
        $passportValids++;
    } else if (count($diffKeys) == 1 && isset($diffKeys['cid'])) {
        $passportValids++;
    }
}

echo $passportValids;