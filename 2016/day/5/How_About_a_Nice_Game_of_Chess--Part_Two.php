<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(strstr(__FILE__, "--", true), ".php"), "r");

$input = fgets($handle);

set_time_limit(300);

////////////////////////////////////////////////////////////////////////////////

$i = $j = 0;
$code = array();
while (count($code) < 8) {
    $myMD5 = md5($input . $i);
    if (substr($myMD5, 0, 5) === "00000") {
        $split = str_split($myMD5);
        $pos = hexdec($split[5]);
        $chr = $split[6];
        if ($pos < 8 && !isset($code[$pos])) {
            $code[$pos] = $chr;
        }
    }
    $i++;
}

if (ksort($code))
    echo join($code); ?>

////////////////////////////////////////////////////////////////////////////////


Given the actual Door ID and this new method, what is the password? Be extra proud of your solution if it uses a cinematic "decrypting" animation.

Your puzzle answer was 863dde27.