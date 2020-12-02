<?php

$input = include_once("day4_input.php");

$passphrases = explode("\n", $input);

$countValidPassphrases = 0;

foreach ($passphrases as $passphrase) {
    $passwordsA = explode(" ", $passphrase);
    $passwordsB = explode(" ", $passphrase);

    $passphraseTester = [];

    $validPassphrase = true;
    
    foreach ($passwordsA as $keyA => $passwordA) {
        foreach ($passwordsB as $keyB => $passwordB) {
            if ($keyA !== $keyB) {
                $passwordAnagram1 = count_chars($passwordA);
                $passwordAnagram2 = count_chars($passwordB);

                $noDiffPasswords = ($passwordAnagram1 == $passwordAnagram2);
                
                if ($noDiffPasswords) {
                    $validPassphrase = false;
                    break 2;
                }
            }
        }
    }

    if ($validPassphrase) {
        $countValidPassphrases++;
    }
}

echo $countValidPassphrases;