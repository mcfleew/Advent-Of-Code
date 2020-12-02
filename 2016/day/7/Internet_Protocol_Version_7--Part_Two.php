<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(strstr(__FILE__, "--", true), ".php"), "r");

function Get_All_ABBAs($chrsRaw) {
    $chrs = str_split($chrsRaw);
    $ABBAs = array();
    foreach ($chrs as $key => $chr) {
        $chrPrev = (isset($chrs[$key - 1])) ? $chrs[$key - 1] : "";
        $chrCurr = $chr;
        $chrNext = (isset($chrs[$key + 1])) ? $chrs[$key + 1] : "";
        
        if ($chrPrev == $chrNext) {
            if ($chrCurr != $chrNext) {
                $ABBAs[] = $chrPrev.$chrCurr.$chrNext;
            }
        }
    }
        
    return $ABBAs;
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
    
    $outBracketsABBA = Get_All_ABBAs($chrsBesides);
    $inBracketsABBA = Get_All_ABBAs($chrsWithin);
    
    foreach ($outBracketsABBA as $ABA) {
        $spl = str_split($ABA);
        $BAB = $spl[1] . $spl[0] . $spl[1];
        
        if (in_array($BAB, $inBracketsABBA)) {
            $count++;
            break;
        }
    }
}

echo $count; ?>

////////////////////////////////////////////////////////////////////////////////


How many IPs in your puzzle input support SSL?

Your puzzle answer was 231.