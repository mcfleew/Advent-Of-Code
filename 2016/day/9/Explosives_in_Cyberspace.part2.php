<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

$input = fgets($handle);

$chrs = array();
for ($i = 0; $i <= 1000; $i++) {
    if (in_array(chr($i), $chrs)) {
        print_r($chrs);
        exit;
    }
    $chrs[$i] = chr($i);
}

////////////////////////////////////////////////////////////////////////////////

$split = str_split(str_replace(" ", "", $input));

$final = "";
$toContinue = false;
foreach ($split as $pos => $chr) {
    if ($chr == "(") {
        $toContinue = true;
    }
    $final .= "";
}

