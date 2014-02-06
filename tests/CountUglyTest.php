<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/3/14
 * Time: 12:36 PM
 * Copyright Cympel Inc
 */
require_once("ugly.php");

class CountUglyTest extends PHPUnit_Framework_TestCase
{
    public function testCountUgly()
    {
        // 1 gives 0
        $count = UglyCounter::countUgly('1');
        $this->assertEquals(0, $count);
        // 9 gives 1
        $count = UglyCounter::countUgly('9');
        $this->assertEquals(1, $count);
        // 011 gives 6
        $count = UglyCounter::countUgly('011');
        $this->assertEquals(6, $count);
        // 12345 gives 64
        $count = UglyCounter::countUgly('12345');
        $this->assertEquals(64, $count);
        // 66 gives 0, 12, 66 which should give 3
        $count = UglyCounter::countUgly('66');
        $this->assertEquals(3, $count);

        // 981 gives 0, 2, -72, 18, 16, 90, 97, 99, 981 should give 8
        $count = UglyCounter::countUgly('981');
        $this->assertEquals(8, $count);

        // 0 gives 1
        $count = UglyCounter::countUgly('0');
        $this->assertEquals(1, $count);
        // Validate that really big numbers don't crash
        //$count = countUgly('123456789012');
        //$this->assertTrue(true);


    }
}