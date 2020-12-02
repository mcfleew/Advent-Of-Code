<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

////////////////////////////////////////////////////////////////////////////////

$count = 0;

while (($buffer = fgets($handle)) !== false) {
    $encrypted = preg_split("/[\[\]]/", $buffer);
    preg_match_all("/[a-z]/", $encrypted[0], $outChr);
    preg_match_all("/[0-9]/", $encrypted[0], $outNum);
    $checksum = str_split($encrypted[1]);
    $sectorId = join($outNum[0]);
    
    $arr = array();
    foreach ($outChr[0] as $chr) {
        if (!array_key_exists($chr, $arr)) {
            $arr[$chr] = 0;
        }
        $arr[$chr]++;
    }
    
    arsort($arr);
    $lastVal = 0;
    $theKeys = array();
    foreach ($arr as $k => $v) {
        if (count($theKeys) < 5 || $v >= $lastVal) {
            $theKeys[$k] = $v;
        } else {
            break;
        }
        $lastVal = $v;
    }
    
    $valid = true;
    $lastChk = "";
    foreach ($checksum as $check) {
        if (!array_key_exists($check, $theKeys) || ($lastChk != "" && $theKeys[$check] > $theKeys[$lastChk])) {
            $valid = false;
            break;
        }
        $lastChk = $check;
    }

    if ($valid) {
        $count += $sectorId;
    }
}

echo $count; ?>

////////////////////////////////////////////////////////////////////////////////


What is the sum of the sector IDs of the real rooms?

Your puzzle answer was 173787.