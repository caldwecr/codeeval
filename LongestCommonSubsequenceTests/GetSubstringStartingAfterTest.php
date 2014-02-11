<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/11/14
 * Time: 3:22 PM
 */
require_once("longestCommonSubsequence.php");

class GetSubstringStartingAfterTest extends PHPUnit_Framework_TestCase
{
    public function testGetSubstringStartingWith()
    {
        // b of 'abcd' gives 'bcd'
        $needle = 'b';
        $haystack = 'abcd';
        $result = getSubstringStartingAfter($needle, $haystack);
        $this->assertEquals('cd', $result);

        // b of 'gfhi' gives ''
        $needle = 'b';
        $haystack = 'gfhi';
        $result = getSubstringStartingAfter($needle, $haystack);
        $this->assertEquals('', $result);
    }
}