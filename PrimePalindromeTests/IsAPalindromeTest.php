<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/10/14
 * Time: 12:32 PM
 * Copyright Cympel Inc
 */
require_once("primePalindrome.php");

class IsAPalindromeTest extends PHPUnit_Framework_TestCase
{
    public function testIsAPalindrome()
    {
        // value = '123'; returns false
        $value = '123';
        $result = isAPalindrome($value);
        $this->assertFalse($result);

        // value = '0'; return true;
        $value = '0';
        $result = isAPalindrome($value);
        $this->assertTrue($result);

        // value 3113; return true
        $value = 3113;
        $result = isAPalindrome($value);
        $this->assertTrue($result);
    }
}