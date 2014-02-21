<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/21/14
 * Time: 1:56 PM
 */

function strstrRedo($haystack, $needle)
{
    $haystackAsArray = str_split($haystack);
    $needleAsArray = str_split($needle);
    $haystackLength = count($haystackAsArray);
    $firstCharPosition = -1;
    // Step 1: Iterate through haystack until value matches first value of needle
    for($k = 0; $k < $haystackLength; $k++) {
        $iFirstCharPosition = -1;
        foreach($haystackAsArray as $key => $value) {
            if($value === $needleAsArray[0]) {
                $iFirstCharPosition = $key;
            }
        }
        if($iFirstCharPosition !== -1) {
            // Step 2: Until end of needle make sure consecutive needle values match haystack
            $needlePos = 0;
            $needleLength = count($needleAsArray);
            for($i = 1; $i < $needleLength; $i++ ) {
                if($haystackAsArray[$iFirstCharPosition + $i] === $needleAsArray[$i]) {
                    $needlePos++;
                } else {
                    $iFirstCharPosition = -1;
                }
            }
        }
        if($firstCharPosition === -1 && $iFirstCharPosition !== -1) {
            $firstCharPosition = $iFirstCharPosition;
        }
    }
    // Step 3: Needle is fully matched return pos of first char of needle in haystack
    return $firstCharPosition;
}

strstrRedo('abcdefg', 'abc');