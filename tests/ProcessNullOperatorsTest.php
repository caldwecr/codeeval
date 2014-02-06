<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/3/14
 * Time: 1:02 PM
 * Copyright Cympel Inc
 */
require_once("ugly.php");

class ProcessNullOperatorsTest extends PHPUnit_Framework_TestCase
{
    public function testProcessNullOperators()
    {
        // 1
        $digits = array(
            0 => 1,
        );
        $operators = array();
        processNullOperators($digits, $operators);
        $this->assertEquals(1, $digits[0]);
        $this->assertFalse(array_key_exists(0, $operators));

        // 5 + 6
        $digits = array(
            0 => 5,
            1 => 6,
        );
        $operators = array(
            1 => '+',
        );
        processNullOperators($digits, $operators);
        $this->assertEquals(5, $digits[0]);
        $this->assertEquals(6, $digits[1]);
        $this->assertEquals('+', $operators[1]);

        // 123
        $digits = array(
            0 => 1,
            1 => 2,
            2 => 3,
        );
        $operators = array(
            1 => 'no',
            2 => 'no',
        );
        processNullOperators($digits, $operators);
        $this->assertEquals(123, $digits[0]);

        // 256 + 12 - 04
        $digits = array(
            0 => 2,
            1 => 5,
            2 => 6,
            3 => 1,
            4 => 2,
            5 => 0,
            6 => 4,
        );
        $operators = array(
            1 => 'no',
            2 => 'no',
            3 => '+',
            4 => 'no',
            5 => '-',
            6 => 'no',
        );
        processNullOperators($digits, $operators);
        $this->assertEquals(256, $digits[0]);
        $this->assertEquals(12, $digits[3]);
        $this->assertEquals(4, $digits[5]);
        $this->assertFalse(array_key_exists(1, $operators));
        $this->assertFalse(array_key_exists(2, $operators));
        $this->assertTrue(array_key_exists(3, $operators));
        $this->assertEquals('+', $operators[3]);
        $this->assertFalse(array_key_exists(4, $operators));
        $this->assertTrue(array_key_exists(5, $operators));
        $this->assertEquals('-', $operators[5]);
        $this->assertFalse(array_key_exists(6, $operators));
    }
}