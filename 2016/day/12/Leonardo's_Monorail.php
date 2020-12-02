<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$handle = @fopen(basename(__FILE__, ".php"), "r");

////////////////////////////////////////////////////////////////////////////////

$instructions = array();

while (($buffer = fgets($handle)) !== false) {
    $instruction = explode(" ", $buffer);
    
    if (2 == count($instruction)) {
        list($arr['cmd'], $arr['var'], $arr['input']) = array_pad($instruction, 3, null);
    } else if (3 == count($instruction)) {
        list($arr['cmd'], $arr['input'], $arr['var']) = $instruction;
    }
    
    $instructions[] = array_map("trim", $arr);
}

//print_r($instructions); exit;

$idx = $a = $b = $c = $d = 0;
$c = 1;
while ($idx < count($instructions)) {
    $toNextInstruction = true;
    extract($instructions[$idx]);
    
    switch ($cmd) {
        case "cpy":
            if (isset($$input)) {
                $$var = $$input;
            } else {
                $$var = $input; 
            }
            break;
        case "inc":
            $$var++; break;
        case "dec":
            $$var--; break;
        case "jnz":
            $var2 = (isset($$input)) ? $$input : $input;
            if ($var2 !== 0) {
                $toNextInstruction = false;
                $idx += $var; 
            } break;
    }
    
    if ($toNextInstruction) {
        $idx++;
    }
}

var_dump($a, $b, $c, $d); exit;