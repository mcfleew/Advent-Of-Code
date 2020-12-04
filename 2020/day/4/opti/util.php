<?php

function getCredentials($input) {
    return explode(str_repeat(PHP_EOL, 2), $input);
}

function getRequiredFields($requiredFields) {
    return array_flip($requiredFields);
}

function splitBySpaceOrNewLine($credential) {
    return  preg_split('/\s|\n/', $credential);
}

function getCredentialFields($credential) {
    $credentialFieldsRaw = splitBySpaceOrNewLine($credential);
    $credentialFields = [];

    foreach($credentialFieldsRaw as $fieldString) {
        if ($fieldString) {
            list($key, $value) = getKeyValueFromString($fieldString);
            $credentialFields[$key] = $value;
        }
    }

    return $credentialFields;
}

function getKeyValueFromString($fieldString) {
    return explode(':', $fieldString);
}

function ignoreCid($fields) {
    ksort($fields);
    unset($fields['cid']);
    return $fields;
}

function scanPassport($requiredFields, $credentialFields) {;
    return hasDifferences($requiredFields, $credentialFields);
}

function hasDifferences($requiredFields, $credentialFields) {
    $differences = getDifferencesBetween($requiredFields, $credentialFields);
    return (count($differences) == 0);
}

function getDifferencesBetween($requiredFields, $credentialFields) {
    return array_diff_key($requiredFields, $credentialFields);
}