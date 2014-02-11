<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/11/14
 * Time: 4:07 PM
 */

$ceiling = 1000;
echo getLargestPrimePalindromeUnder($ceiling);

/**
 * @param int $ceiling
 * @return int
 *
 * Returns the largest number which is a palindrome and is prime that is less than $maxValue
 */
function getLargestPrimePalindromeUnder($ceiling)
{
    $primes = getPrimesUnder($ceiling);
    $reversedPrimes = array_reverse($primes);

    foreach($reversedPrimes as $key => $value) {
        if(isAPalindrome($value)) {
            return $value;
        }
    }
    return -1;
}

/**
 * @param $value
 * @return bool
 *
 * Used an unconventional name here for a method that is an exact copy of isPalindrome but because includes are impractical for
 * CodeEval submissions I've duplicated the method here and given it a different name
 */
function isAPalindrome($value)
{
    $sValue = '' . $value . '';
    return $sValue === strrev($sValue);
}

/**
 * @param $ceiling
 * @return array
 * @throws Exception
 *
 * Generates an array of all primes less than the ceiling 
 */
function getPrimesUnder($ceiling)
{
    if($ceiling < 3) throw new Exception("getPrimesUnder accepts an integer greater than or equal to three as its argument.");
    $primes = array(
        2,
    );

    for($i = 3; $i < $ceiling; $i+=2) {
        reset($primes);
        $prime = true;
        while($prime) {
            if($i % current($primes) === 0) {
                $prime = false;
            } else if(next($primes) === false) { // there are no more elements in the array
                $primes[] = $i;
            }
        }
    }
    return $primes;
}