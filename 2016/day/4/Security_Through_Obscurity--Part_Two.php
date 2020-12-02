<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(strstr(__FILE__, "--", true), ".php"), "r");

////////////////////////////////////////////////////////////////////////////////

$count = 0;
$alphabet = array_combine(range("a", "z"), range(0, 25));
$ralphabet = array_flip($alphabet);

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
        $pieces = array();
        $step = $sectorId % 26;
        $names = explode("-", $encrypted[0]);
        array_pop($names);
        foreach($names as $name) {
            $word = "";
            $word2 = "";
            foreach (str_split($name) as $chr) {
                $step2 = (($step + $alphabet[$chr]) % 26);
                $word .= $ralphabet[$step2];
            }
            $pieces[] = $word;
        }     
        $realName = join(" ", $pieces);
                
        if (strpos($realName, "northpole") !== false) {
            echo $sectorId; exit;
        }
    }
} ?>

////////////////////////////////////////////////////////////////////////////////


What is the sector ID of the room where North Pole objects are stored?

Your puzzle answer was 548.