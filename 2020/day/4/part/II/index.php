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
    unset($diffKeys['cid']);

    if (count($diffKeys) == 0) {
        unset($newFields['cid']);
        ksort($newFields);
        if (!testByr($newFields['byr'])) continue;
        if (!testIyr($newFields['iyr'])) continue;
        if (!testEyr($newFields['eyr'])) continue;
        if (!testHgt($newFields['hgt'])) continue;
        if (!testHcl($newFields['hcl'])) continue;
        if (!testEcl($newFields['ecl'])) continue;
        if (!testPid($newFields['pid'])) continue;
        // print_r($newFields);
        $passportValids++;
    }
}

echo $passportValids;

function testByr($value) {
    if (1920 <= $value && $value <= 2002) {
        return true;
    }
    return false;
}

function testIyr($value) {
    if (2010 <= $value && $value <= 2020) {
        return true;
    }
    return false;
}

function testEyr($value) {
    if (2020 <= $value && $value <= 2030) {
        return true;
    }
    return false;
}

function testHgt($value) {
    $return = false;
    if (preg_match('/^([0-9]{2,3})(cm|in)$/', $value, $matches)) {
        if ($matches[2] == 'cm' && (150 <= $matches[1] && $matches[1] <= 193)) {
            $return = true;
        }
        if ($matches[2] == 'in' && (59 <= $matches[1] && $matches[1] <= 76)) {
            $return = true;
        }
    }
    return $return;
}

function testHcl($value) {
    if (preg_match('/^#[0-9a-f]{6}$/', $value)) {
        return true;
    }
    return false;
}

function testEcl($value) {
    if (preg_match('/^(amb|blu|brn|gry|grn|hzl|oth)$/', $value)) {
        return true;
    }
    return false;
}

function testPid($value) {
    if (preg_match('/^[0-9]{9}$/', $value)) {
        return true;
    }
    return false;
}