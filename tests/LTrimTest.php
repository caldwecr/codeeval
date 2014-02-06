<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/4/14
 * Time: 9:50 AM
 * Copyright Cympel Inc
 */
require_once("ugly.php");

class LTrimTest extends PHPUnit_Framework_TestCase
{
    public function testLTrim()
    {
        // See if 011 has the same number of ugly numbers as 11
        $countA = UglyCounter::countUgly('11');
        $countB = UglyCounter::countUgly('011');
        $this->assertNotEquals($countA, $countB);

        // See if 00011 has 3^2=9 more ugly numbers as 011
        $countA = UglyCounter::countUgly('011');
        $countB = UglyCounter::countUgly('00011');
        $this->assertEquals($countA * 9, $countB);

        // See if 000011 has 3^3=27 more ugly numbers as 011
        $countA = UglyCounter::countUgly('011');
        $countB = UglyCounter::countUgly('000011');
        $this->assertEquals($countA * 27, $countB);

        // Does 00000 have 3^4 more ugly numbers as 0
        $countA = UglyCounter::countUgly('0');
        $countB = UglyCounter::countUgly('00000');
        $this->assertEquals(pow(3, 4) * $countA, $countB);
    }

}