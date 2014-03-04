<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/3/14
 * Time: 12:47 PM
 */

/**
 * @param string $h1
 * @param string $h2
 * @return int
 *
 * Proposed solution is to normalize the dom hierarchies into traditional phrases containing words containing letters,
 * then calculate the Longest Common Subsequence, determine the number of removal operations on h1 needed to make it match the LCS,
 * then calculate the number of insertion operations required to make it match h2
 *
 * I had an existing LCS algorithm from a different coding challenge that I've included here
 */
function heapenson($h1, $h2)
{
    normalizer($h1, $h2);
    classSorter($h1);
    classSorter($h2);
    capsElements($h1);
    capsElements($h2);
    $lcs = getLCSDynamicProgramming($h1, $h2);
    var_dump($h1, $h2, $lcs);
    $opCount = 0;
    $reducedH1 = reduceToV2($h1, $lcs, $opCount);
    var_dump("After reduction total opCount = {$opCount}");
    $insertedH1 = insertTo($reducedH1, $h2, $opCount);
    var_dump("After insertion total opCount = {$opCount}");
    return $opCount;
}

function capsElements(&$foo)
{
    $fArr = explode('*', $foo);
    foreach($fArr as $key => $value) {
        $fArr[$key] = ucwords($value);
    }
    $foo = implode('*', $fArr);
}


function reduceToV2($reduceMe, $lcs, &$operationCounter)
{
    $rArr = explode('*', $reduceMe);
    $lArr = explode('*', $lcs);
    // Remove the elements from reduceMe that do not occur in the lcs
    $offset = 0;
    foreach($rArr as $key => $value) {
        if(array_key_exists($key + $offset, $lArr)) {
            $r = substr($value, 0, 1);
            $l = substr($lArr[$key + $offset], 0, 1);
            //var_dump($r, $l);
            if($r != $l) {
                unset($rArr[$key]);
                $offset--;
                $operationCounter++;
                //var_dump('ELEMENT REDUCED');
            }
        } else {
            unset($rArr[$key]);
            $offset--;
            $operationCounter++;
            //var_dump('ELEMENT REDUCED');
        }
    }

    // Explode reduceMe and lcs into their elements (explode on *)
    // Foreach explodedReduceMe remove id's and classes that are not in the corresponding lcs

    // Redo the keys on the rArr so the unsetted items won't interfere with iteration across $lArr
    $rArr = array_values($rArr);
    //var_dump($rArr, $lArr);

    foreach($rArr as $key => $value) {
        $rId = substr($value, 1, 1);
        $lId = substr($lArr[$key], 1, 1);
        if($rId && $rId != '{') {
            if($rId != $lId) {
                $rArr[$key] = str_replace($rId, '', $value);
                $operationCounter++;
                //var_dump('ID REDUCED');
            }
        }
        $rClassListStartIndex = strpos($value, '{') + 1;
        $rClassListLength = strpos($value, '}') - $rClassListStartIndex;
        $rClassList = substr($value, $rClassListStartIndex, $rClassListLength);

        $lClassListStartIndex = strpos($lArr[$key], '{') + 1;
        $lClassListLength = strpos($lArr[$key], '}') - $lClassListStartIndex;
        $lClassList = substr($lArr[$key], $lClassListStartIndex, $lClassListLength);
        $rCLArr = str_split($rClassList);

        foreach($rCLArr as $iKey => $iValue) {
            if($iValue && strpos($lClassList, $iValue) === false) {
                unset($rCLArr[$iKey]);
                $operationCounter++;
                //var_dump("CLASS REDUCED {$iValue}");
            }
        }
        $newRClassList = implode('', $rCLArr);
        $rArr[$key] = str_replace('{' . $rClassList . '}', '{' . $newRClassList . '}', $value);
    }
    $reduceMe = implode('*', $rArr);
    //if($reduceMe != $lcs) throw new Exception("Reduced string does not equal LCS in reduceToV2. reduced ={$reduceMe}, lcs = {$lcs}");
    return $lcs;
}

function insertTo($insertIntoMe, $target, &$operationCounter)
{
    $iArr = str_split($insertIntoMe);
    $tArr = str_split($target);
    $offset = 0;
    //var_dump($iArr);
    foreach($tArr as $key => $value) {
        //var_dump($key + $offset);
        if(!array_key_exists($key + $offset, $iArr) || $value != $iArr[$key + $offset]) {
            $offset--;
            $operationCounter++;
            if($value == '*' || $value == '{' || $value == '}') {
                $operationCounter --;
            }
        }
        //var_dump($operationCounter);
    }
    return $target;
}


function classSorter(&$foo)
{
    $fArr = str_split($foo);
    $classList = '';
    $inClassList = false;
    foreach($fArr as $key => $value) {
        if($value === '}') {
            $inClassList = false;
            $clArr = str_split($classList);
            natcasesort($clArr);
            $sortedClassList = '{' . implode('', $clArr) . '}';
            $search = '{' . $classList . '}';
            //var_dump($search, $sortedClassList, $foo);
            $foo = str_replace($search, $sortedClassList, $foo);
        }
        if($inClassList) {
            $classList .= $value;
        }
        if($value === '{') {
            $inClassList = true;
        }
    }

}

/**
 * @param string $foo
 * @param string $bar
 *
 * This method converts a pair of dom hierarchy elements into a common character vocabulary, this is achieved by
 * detecting the presence of white spaces, periods, and hashes to be the delimeters between hierarchy characters
 *
 * For example given
 * h1 = div#chick.banana.taco ul
 * h2 = ul div#chick
 *
 * h1 would become *abcd*e
 * h2 would become *e*ab
 */
function normalizer(&$foo, &$bar)
{
    $replacements = array();
    $f = str_split($foo);
    $b = str_split($bar);

    $newFoo = '';
    $newBar = '';

    $currentSubstring = '';
    $currentChar = 'a';
    normalizerHelper($f, $currentChar, $currentSubstring, $replacements, $newFoo);
    normalizerHelper($b, $currentChar, $currentSubstring, $replacements, $newBar);

    $foo = $newFoo;
    $bar = $newBar;
}

function normalizerHelper($arr, &$currentChar, &$currentSubstring, &$replacements, &$normalizedString)
{
    $currentSubstring = '';
    if(!($arr[0] === '#' || $arr[0] === '.' || $arr[0] === ' ')) {
        $currentSubstring .= ' ';
        $normalizedString .= '*';
    }
    $inClassList = false;
    foreach($arr as $key => $value) {
        if($value === '#' || $value === '.' || $value === ' ') {
            // New 'character' detected
            $t = $currentChar;
            if(!array_key_exists($currentSubstring, $replacements)) {
                $replacements[$currentSubstring] = $currentChar;
                $currentChar = chr(ord($currentChar) + 1);
            } else {
                //the currentSubstring is already defined in the replacements array
                $t = $replacements[$currentSubstring];
            }
            $currentSubstring = $value;

            $normalizedString .= $t;

            if($value === '.' && !$inClassList) {
                $normalizedString .= '{';
                $inClassList = true;
            }
            if($value !== '.' && $inClassList) {
                $normalizedString .= '}';
                $inClassList = false;
            }
            if($value === ' ') {
                $normalizedString .= '*';
            }
        } else {
            $currentSubstring .= $value;
        }
    }
    if($currentSubstring) {
        $t = $currentChar;
        if(!array_key_exists($currentSubstring, $replacements)) {
            $replacements[$currentSubstring] = $currentChar;
            $currentChar = chr(ord($currentChar) + 1);
        } else {
            //the currentSubstring is already defined in the replacements array
            $t = $replacements[$currentSubstring];
        }
        $normalizedString .= $t;
        if($inClassList) {
            $normalizedString .= '}';
        }
    }
}

/**
 * @param $left
 * @param $right
 * @return string
 *
 * Algorithm from wikipedia - converted from java, modified for use
 */
function getLCSDynamicProgramming($left, $right)
{
    $lengths = array();
    buildArray($left, $right, $lengths);
    $lLength = strlen($left);
    $rLength = strlen($right);

    // Whenever we find a meaningful character in the progression increment the score by this amount,
    // non-meaningful (grammaitcal characters like *, {, and } receive 1 point thus the string is correctly
    // reassembled by the DP alogrithm, and yet the grammatical characters cannot be counted so much
    // that the wrong path is selected.
    $significantCharacterIncrement = $lLength * $rLength;

    $lArr = str_split($left);
    $rArr = str_split($right);
    for($i = 0; $i < strlen($left); $i++) {
        for($j = 0; $j < strlen($right); $j++) {
            if($lArr[$i] == $rArr[$j]) {
                if($lArr[$i] == '*' || $lArr[$i] == '{' || $lArr[$i] == '}') {
                    $lengths[$i + 1][$j + 1] = $lengths[$i][$j] + 1;
                } else $lengths[$i + 1][$j + 1] = $lengths[$i][$j] + $significantCharacterIncrement;
            } else {
                $lengths[$i + 1][$j + 1] = max($lengths[$i + 1][$j], $lengths[$i][$j + 1]);
            }
        }
    }
    //prettyPrintArray($lengths);
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
    $toReturn = strrev($s);
    $sub = substr($toReturn, 1);
    if($sub != '{}' && $sub == lcfirst($sub)) {
        // This is an invalid LCS because it begins like *x, valid LCS begin like *X
        $charToRemove = substr($sub, 0, 1);
        $left = str_replace($charToRemove, '', $left);
        $right = str_replace($charToRemove, '', $right);
        //var_dump($toReturn);
        $toReturn = getLCSDynamicProgramming($left, $right);
    }
    return $toReturn;
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

function prettyPrintArray($twoDArray)
{
    $toReturn = '';
    foreach($twoDArray as $outerKey => $outerValue) {
        foreach($outerValue as $innerKey => $innerValue) {
            $toReturn .= '|' . $innerValue;
        }
        $toReturn .= "\n";
    }
    echo $toReturn;
}