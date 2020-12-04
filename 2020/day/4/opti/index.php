<?php echo '<pre>';

include 'util.php';

$input = file_get_contents('../input');
$credentials = getCredentials($input);

$requiredFields = getRequiredFields([
    'byr', // (Birth Year)
    'iyr', // (Issue Year)
    'eyr', // (Expiration Year)
    'hgt', // (Height)
    'hcl', // (Hair Color)
    'ecl', // (Eye Color)
    'pid', // (Passport ID)
    'cid', // (Country ID)
]);

$countValidCrendentials = 0;

foreach($credentials as $credential) {
    $credentialFields = getCredentialFields($credential);

    $requiredFields = ignoreCid($requiredFields);
    $credentialFields = ignoreCid($credentialFields);

    if (scanPassport($requiredFields, $credentialFields)) {
        if (!isValidByrField($credentialFields['byr'])) continue;
        if (!isValidIyrField($credentialFields['iyr'])) continue;
        if (!isValidEyrField($credentialFields['eyr'])) continue;
        if (!isValidHgtField($credentialFields['hgt'])) continue;
        if (!isValidHclField($credentialFields['hcl'])) continue;
        if (!isValidEclField($credentialFields['ecl'])) continue;
        if (!isValidPidField($credentialFields['pid'])) continue;
        $countValidCrendentials++;
    }
}

echo $countValidCrendentials;

function isValidByrField($year) {
    if (1920 <= $year && $year <= 2002) {
        return true;
    }
    return false;
}

function isValidIyrField($year) {
    if (2010 <= $year && $year <= 2020) {
        return true;
    }
    return false;
}

function isValidEyrField($year) {
    if (2020 <= $year && $year <= 2030) {
        return true;
    }
    return false;
}

function isValidHgtField($height) {
    $isValidField = false;

    if (preg_match('/^([0-9]{2,3})(cm|in)$/', $height, $matches)) {
        list(, $size, $metric) = $matches;

        if ($metric == 'cm' && (150 <= $size && $size <= 193)) {
            $isValidField = true;
        }
        if ($metric == 'in' && (59 <= $size && $size <= 76)) {
            $isValidField = true;
        }
    }
    return $isValidField;
}

function isValidHclField($hexaColor) {
    if (preg_match('/^#[0-9a-f]{6}$/', $hexaColor)) {
        return true;
    }
    return false;
}

function isValidEclField($color) {
    if (preg_match('/^(amb|blu|brn|gry|grn|hzl|oth)$/', $color)) {
        return true;
    }
    return false;
}

function isValidPidField($id) {
    if (preg_match('/^[0-9]{9}$/', $id)) {
        return true;
    }
    return false;
}