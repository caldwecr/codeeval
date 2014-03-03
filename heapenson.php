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
    $lcs = getLCS($h1, $h2);
    var_dump($h1, $h2, $lcs);
    $opCount = 0;
    $reducedH1 = reduceTo($h1, $lcs, $opCount);
    var_dump($opCount);
    $insertedH1 = insertTo($reducedH1, $h2, $opCount);
    var_dump($opCount);
    return $opCount;
}

function reduceTo($reduceMe, $lcs, &$operationCounter)
{
    $rArr = explode('*', $reduceMe);
    $lcsArr = explode('*', $lcs);
    $reduced = array();
    $offset = 0;
    $originalOperationCounter = $operationCounter;
    foreach($rArr as $key => $value) {
        if(!array_key_exists($key+$offset, $lcsArr) || $value != $lcsArr[$key + $offset]) {
            $operationCounter++;
            $offset--;
        } else {
            $reduced[] = $value;
        }
    }
    $reducedStr = implode('', $reduced);
    $lcsStr = implode('', $lcsArr);
    // Normalize empty class lists before performing comparison of lcs and reduced
    $lcsStr = str_replace('{}', '', $lcsStr);
    if($reducedStr != $lcsStr) {
        //var_dump($reducedStr, $lcsStr);
        $operationCounter = $originalOperationCounter;
        // Need to perform reduction at the id / class lvl
        $rArr = str_split($reduceMe);
        $lcsArr = str_split($lcs);
        $offset = 0;
        foreach($rArr as $key => $value) {
            if(!array_key_exists($key+$offset, $lcsArr) || $value != $lcsArr[$key + $offset]) {
                $operationCounter++;
                $offset--;
                if($value == '{' || $value == '}') {
                    $operationCounter--;
                }
            } else {
                $reduced[] = $value;
            }
        }
    }
    return $lcs;
}

function insertTo($insertIntoMe, $target, &$operationCounter)
{
    $iArr = str_split($insertIntoMe);
    $tArr = str_split($target);
    $offset = 0;
    foreach($tArr as $key => $value) {
        if($value != $iArr[$key + $offset]) {
            $offset--;
            $operationCounter++;
            if($value == '*' || $value == '{' || $value == '}') {
                $operationCounter --;
            }
        }
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