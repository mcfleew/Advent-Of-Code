<?php

$input = include_once("day4_input.php");

$passphrases = explode("\n", $input);

$countValidPassphrases = 0;

foreach ($passphrases as $passphrase) {
    $passwords = explode(" ", $passphrase);

    $passphraseTester = [];

    $validPassphrase = true;

    $passwordsCountValues = array_count_values($passwords);
    
    foreach ($passwordsCountValues as $count) {
        if ($count > 1 ) {
            $validPassphrase = false;
            break;
        }
    }
    /*
    foreach ($passwords as $password) {
        if (in_array($password, $passphraseTester)) {
            $validPassphrase = false;
            break;
        }
        $passphraseTester[] = $password;
    }*/

    if ($validPassphrase) {
        $countValidPassphrases++;
    }
}

echo $countValidPassphrases;