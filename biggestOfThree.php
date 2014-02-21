<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/21/14
 * Time: 1:39 PM
 */

/**
 * @param int $a
 * @param int $b
 * @param int $c
 * @return int
 *
 *
 * Return the greatest of the three parameters
 */
function biggestOfThree($a, $b, $c)
{
    $toReturn = $a;
    if($b > $toReturn) $toReturn = $b;
    if($c > $toReturn) $toReturn = $c;
    return $toReturn;

}


function biggest()
{
    $argList = func_get_args();
    $toReturn = current($argList);
    foreach($argList as $key => $value) {
        $toReturn = $toReturn > $value ? $toReturn : $value;
    }
    return $toReturn;
}

echo biggest(1, 2, 0, -2, -25, 2, 13, 13, 129, -2);
