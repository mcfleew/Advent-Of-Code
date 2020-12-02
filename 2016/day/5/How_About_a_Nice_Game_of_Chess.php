<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

$input = fgets($handle);

set_time_limit(300);

////////////////////////////////////////////////////////////////////////////////

$i = $j = 0;
$code = "";
while (strlen($code) < 8) {
    $myMD5 = md5($input . $i);
    if (substr($myMD5, 0, 5) === "00000") {
        $code .= str_split($myMD5)[5];
    }
    $i++;
}

echo $code; ?>

////////////////////////////////////////////////////////////////////////////////


Given the actual Door ID, what is the password?

Your puzzle answer was f97c354d.