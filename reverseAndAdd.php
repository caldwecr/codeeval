<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/10/14
 * Time: 12:20 PM
 */
if($argc > 1) {
    $input = file_get_contents($argv[1]);
    // Split the lines
    $input_values = explode(PHP_EOL, $input);
    echo doReverseAndAdd($input_values);
}
/**
 * @param $valuesArray
 * @return string
 *
 * This method iterates through the values array finding the addition operation count and the reverse and add palindrome for each value
 */
function doReverseAndAdd($valuesArray)
{
    $toReturn = '';
    foreach($valuesArray as $key => $value) {
        $current = $value;
        $count = 0;
        while(!isPalindrome($current)) {
            $current = reverseAndAdd($current);
            $count++;
        }
        $toReturn .= '' . $count . ' ' . $current . "\n";
    }
    return $toReturn;
}

/**
 * @param string $value
 * @return int
 *
 * This method tags a number as a string, and returns the sum of that number and the reverse of the number as an int
 */
function reverseAndAdd($value = '')
{
    $normal = (int) $value;
    $reverse = (int) strrev($value);
    return $normal + $reverse;
}

/**
 * @param $value
 * @return bool
 */
function isPalindrome($value)
{
    $sValue = '' . $value . '';
    return $sValue === strrev($sValue);
}
