<?php

$input = include_once("day8_input.php");

$instructions = explode("\n", $input);

$variables = [];

$maximumDeLaMontagne = 0;

foreach ($instructions as $instruction) {
    list($operation, $condition) = explode("if", $instruction);

    list($variableToSet, $operator, $value) = explode(" ", trim($operation));

    list($variableToTest, $comparator, $target) = explode(" ", trim($condition));

    if (!isset($variables[$variableToSet])) {
        $variables[$variableToSet] = 0;
    }
    if (!isset($variables[$variableToTest])) {
        $variables[$variableToTest] = 0;
    }
    
    eval("\$testCondition = (".$variables[$variableToTest] . " " . $comparator . " " . $target.");");

    if ($testCondition) {
        switch($operator) {
            case 'inc':
                $variables[$variableToSet] += $value;
                break;
            case 'dec':
                $variables[$variableToSet] -= $value;
                break;
        }

        if ($maximumDeLaMontagne < $variables[$variableToSet]) {
            $maximumDeLaMontagne = $variables[$variableToSet];
        }
    }

}

echo $maximumDeLaMontagne;