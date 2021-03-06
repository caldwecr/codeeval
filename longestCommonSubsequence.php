<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/11/14
 * Time: 2:03 PM
 */

if($argc > 1) {
    $input = file_get_contents($argv[1]);
    // Split the lines
    $input_values = explode(PHP_EOL, $input);
    echo getLCSes($input_values);
}

/**
 * @param array $values
 * @return string
 *
 * This method accepts an array of strings and returns a string containing the Longest Common Subsequence in each
 * position of the array
 */
function getLCSes($values = array())
{
    $toReturn = '';
    foreach($values as $key => $value) {
        $toReturn .= '' . getLCSFromString($value) . "\n";
    }
    return $toReturn;
}

/**
 * @param string $value
 * @return string
 */
function getLCSFromString($value)
{
    $values = explode(';', $value);
    return getLCS($values[0], $values[1]);
}

/**
 * @param string $left
 * @param string $right
 * @return string
 *
 * This method takes two strings and returns a string containing the longest common subsequence
 *
 * I really want to do this iteratively, but for simplicity I'm going to do it recursively and if
 * the performance is poor I will try and make the conversion to an iterative solution
 */
function getLCS($left, $right)
{
    $lCount = strlen($left);
    $rCount = strlen($right);
    if($rCount < $lCount) {
        // Avoid duplicate coding of situations below by flipping operands
        // This lets us assume that there are at least as many chars in right as in left
        return getLCS($right, $left);
    }
    if($lCount === 0) {
        // There can't be a match return ''
        return '';
    } else if($lCount === 1) {
        // There can be at most a one character LCS
        $pos = strpos($right, $left);
        if($pos !== false) {
            return $left;
        } else {
            return '';
        }
    } else {
        $l = str_split($left);
        $r = str_split($right);
        if(strpos($right, $l[0]) !== false) {
            $opt1 = '' . $l[0] . getLCS(getSubstringStartingAfter($l[0], $left), getSubstringStartingAfter($l[0], $right));
            $opt2 = '' . getLCS(getSubstringStartingAfter($l[0], $left), $right);
            return (strlen($opt1) > strlen($opt2) ? $opt1 : $opt2);
        } else {
            return '' . getLCS(getSubstringStartingAfter($l[0], $left), $right);
        }
    }
}

/**
 * @param string $needle
 * @param string $haystack
 * @return string
 */
function getSubstringStartingAfter($needle, $haystack)
{
    // First find the starting index
    $pos = strpos($haystack, $needle);
    if($pos === false) {
        return '';
    }
    return substr($haystack, $pos + 1);
}

function buildArray($left, $right, &$arr)
{
    // Initialize row with index 0 to value 0 and column with index 0 to value 0
    for($i = 0; $i <= strlen($left); $i++) {
        $arr[$i] = array();
        for($j = 0; $j <= strlen($right); $j++) {
            $arr[$i][$j] = 0;
        }
    }
}

/**
 * @param $left
 * @param $right
 * @return string
 *
 * Algorithm from wikipedia - converted from java
 */
function getLCSDynamicProgramming($left, $right)
{
    $lengths = array();
    buildArray($left, $right, $lengths);

    $lArr = str_split($left);
    $rArr = str_split($right);
    for($i = 0; $i < strlen($left); $i++) {
        for($j = 0; $j < strlen($right); $j++) {
            if($lArr[$i] == $rArr[$j]) {
                $lengths[$i + 1][$j + 1] = $lengths[$i][$j] + 1;
            } else {
                $lengths[$i + 1][$j + 1] = max($lengths[$i + 1][$j], $lengths[$i][$j + 1]);
            }
        }
    }

    $s = '';
    for($x = strlen($left), $y = strlen($right);
        $x != 0 && $y != 0;
    ) {
        if($lengths[$x][$y] == $lengths[$x - 1][$y]) {
            $x--;
        } else if($lengths[$x][$y] == $lengths[$x][$y - 1]) {
            $y--;
        } else {
            $s .= $lArr[$x - 1];
            $x--;
            $y--;
        }
    }
    return strrev($s);
}