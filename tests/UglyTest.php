<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/3/14
 * Time: 12:07 PM
 * Copyright Cympel Inc
 */

require_once("ugly.php");

class UglyTest extends PHPUnit_Framework_TestCase
{
    /*
     * Once upon a time in a strange situation, people called a number ugly if it was divisible
     * by any of the one-digit primes (2, 3, 5 or 7). Thus, 14 is ugly, but 13 is fine.
     * 39 is ugly, but 121 is not. Note that 0 is ugly. Also note that negative numbers can also be ugly: -14 and -39
     * are examples of such numbers.
     */

    public function testUgly()
    {
        // Test 14
        $this->assertTrue(isUgly(14));

        // Test 13
        $this->assertFalse(isUgly(13));

        // Test 39
        $this->assertTrue(isUgly(39));

        // Test 121
        $this->assertFalse(isUgly(121));

        // Test 0
        $this->assertTrue(isUgly(0));

        // Test -14
        $this->assertTrue(isUgly(-14));

        // Test -39
        $this->assertTrue(isUgly(-39));

        //Test -13
        $this->assertFalse(isUgly(-13));
    }
}