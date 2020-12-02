<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

function ABBA_In($chrsRaw) {
    $ABBA_In = false;
    
    $chrs = str_split($chrsRaw);
    foreach ($chrs as $key => $chr) {
        $chrM2 = (isset($chrs[$key - 2])) ? $chrs[$key - 2] : "";
        $chrM1 = (isset($chrs[$key - 1])) ? $chrs[$key - 1] : "";
        $chrP1 = $chr;
        $chrP2 = (isset($chrs[$key + 1])) ? $chrs[$key + 1] : "";
        
        if ($chrM1 == $chrP1) {
            if ($chrM2 == $chrP2) {
                if ($chrP1 != $chrP2) {
                    $ABBA_In = true;
                    break;
                }
            }
        }
    }
    
    return $ABBA_In;
}

////////////////////////////////////////////////////////////////////////////////

$count = 0;
$IPs = array();

while (($IP = fgets($handle)) !== false) {
    $chrsSplit = preg_split("/[\[\]]/", $IP);
    $chrsBesides = $chrsWithin = ""; 
    
    foreach ($chrsSplit as $key => $chrs) {
        if ($key % 2 == 0) {
            $chrsBesides .= "|" . $chrs;
        } else {
            $chrsWithin .= "|" . $chrs;
        }
    }
    
    if (ABBA_In($chrsBesides) && !ABBA_In($chrsWithin)) {
        //var_dump($IP);
        $count++;
    }
}

echo $count; ?>

////////////////////////////////////////////////////////////////////////////////


How many IPs in your puzzle input support TLS?

Your puzzle answer was 115.