<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/10/14
 * Time: 11:28 AM
 * Copyright Cympel Inc
 */

if($argc > 1) {
    $input = file_get_contents($argv[1]);
    // Split the lines
    $input_values = explode(PHP_EOL, $input);
    echo calcMaxAdjSum($input_values);
}

/**
 * @param array $values
 */
function calcMaxAdjSum($values)
{
    $splitValues = array();
    valuesSpliter($values, $splitValues);
    $sums = array();
    for($i = count($values) - 1; $i >= 0; $i--) {
        sumRow($i, $splitValues, $sums);
    }
    //var_dump($sums);
    return $sums[0][0];
}

/**
 * @param $rowNumber
 * @param array $values
 * @param array $results
 *
 * This method iterates across the current row of values and places
 * the sum of the current value and the greater of the two adjacenct values in the next row
 * into the results array for the current row
 */
function sumRow($rowNumber, $values = array(), &$results = array())
{
    if(!array_key_exists($rowNumber + 1, $results)) {
        // This is the bottom row of the triangle so just copy the values into the results
        foreach($values[$rowNumber] as $key => $value) {
            $results[$rowNumber][$key] = (int) $value;
        }
    } else if(array_key_exists($rowNumber, $values) && array_key_exists($rowNumber + 1, $values)) {
        $rowCount = count($values[$rowNumber]); // Technically this should equal the row number + 1
        for($i = 0; $i < $rowCount; $i++) {
            $l = (int) $results[$rowNumber + 1][$i];
            $r = (int) $results[$rowNumber+1][$i+1];
            $greaterAdjacentValue = ($l > $r ? $l : $r);
            $results[$rowNumber][$i] = $greaterAdjacentValue + (int) $values[$rowNumber][$i];
        }
    }
}

function valuesSpliter($values, &$splitValues = array())
{
    foreach($values as $key => $value) {
        $splitValues[$key] = explode(' ', $value);
    }
}