<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/6/14
 * Time: 3:02 PM
 * Copyright Cympel Inc
 */
if($argc > 1) {
    $input = file_get_contents($argv[1]);
    // Split the lines
    $input_values = explode(PHP_EOL, $input);
    foreach($input_values as $key => $value) {
        $v = getMthToLast($value);
        if($v !== false) {
            echo $v . "\n";
        }
    }
}

function getMthToLast($input)
{
    $numbers = array();
    $index = -1;
    $toReturn = false;
    parseInput($input, $numbers, $index);
    if(array_key_exists($index, $numbers)) {
        $toReturn = $numbers[$index];
    }
    return $toReturn;
}

function parseInput($input, &$characters, &$index)
{
    $inputArray = explode(' ', $input);
    $myCount = count($inputArray) - 1;
    $index = (int) $inputArray[$myCount];

    //var_dump($inputArray, $index, $myCount);
    // Convert numbers to reverse 1 based array
    for($i = 0; $i < $myCount; $i++) {
        $characters[$myCount - $i] = $inputArray[$i];
    }
}