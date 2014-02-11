<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/11/14
 * Time: 4:09 PM
 */
require_once("primePalindrome.php");

class GetLargestPrimePalindromeUnderTest extends PHPUnit_Framework_TestCase
{
    public function testGetLargestPrimePalindrome()
    {
        // Under 5 result = 3
        $ceiling = 5;
        $result = getLargestPrimePalindromeUnder($ceiling);
        $this->assertEquals(3, $result);
    }
}