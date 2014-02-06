<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/4/14
 * Time: 10:30 AM
 * Copyright Cympel Inc
 */
/**
 * If there is a parameter it should be the file name to read the input from
 */
if($argc > 1) {
    $input = file_get_contents($argv[1]);
    // Split the lines
    $input_values = explode(PHP_EOL, $input);
    foreach($input_values as $key => $value) {
        echo doFizzBuzz($value) . "\n";
    }
}

/**
 * @param string $value
 * @return string
 */
function doFizzBuzz($value)
{
    $a = 0;
    $b = 0;
    $n = 0;
    parseValue($value, $a, $b, $n);

    // Force int type
    $a = (int) $a;
    $b = (int) $b;
    $n = (int) $n;

    $toReturn = '';
    for($i = 1; $i <= $n; $i++) {
        if($i % $a === 0) {
            if($i % $b === 0) {
                $toReturn .= 'FB ';
            } else {
                $toReturn .= 'F ';
            }
        } else if($i % $b === 0) {
            $toReturn .= 'B ';
        } else {
            $toReturn .= $i . ' ';
        }
    }
    return rtrim($toReturn);
}

function parseValue($value, &$a, &$b, &$n)
{
    $values = explode(' ', $value);
    $a = $values[0];
    $b = $values[1];
    $n = $values[2];
}