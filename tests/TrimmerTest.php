<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/4/14
 * Time: 9:58 AM
 * Copyright Cympel Inc
 */
require_once("ugly.php");

class TrimmerTest extends PHPUnit_Framework_TestCase
{
    public function testTrimmer()
    {
        // 0 should trim to 0 and trimmed count should be zero
        $a = '0';
        $trimmedCount = 0;
        $b = trimmer($a, $trimmedCount);
        $this->assertEquals('0', $b);
        $this->assertEquals(0, $trimmedCount);

        // 001 should trim to 01 and trimmed count should be 1
        $a = '001';
        $trimmedCount = 0;
        $b = trimmer($a, $trimmedCount);
        $this->assertEquals('01', $b);
        $this->assertEquals(1, $trimmedCount);

        // 100100 should trim to 100100 and trimmed count should be 0
        $a = '100100';
        $trimmedCount = 0;
        $b = trimmer($a, $trimmedCount);
        $this->assertEquals('100100', $b);
        $this->assertEquals(0, $trimmedCount);

        // 0000123001 should trim to 0123001 and trimmed count should be 3
        $a = '0000123001';
        $trimmedCount = 0;
        $b = trimmer($a, $trimmedCount);
        $this->assertEquals('0123001', $b);
        $this->assertEquals(3, $trimmedCount);
    }
}