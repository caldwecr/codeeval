<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/4/14
 * Time: 10:36 AM
 * Copyright Cympel Inc
 */
require_once("fizzbuzz.php");

class ParseValueTest extends PHPUnit_Framework_TestCase
{
    public function testParseValue()
    {
        $value = '3 5 10';
        parseValue($value, $a, $b, $n);
        $this->assertEquals('3', $a);
        $this->assertEquals('5', $b);
        $this->assertEquals('10', $n);
    }
}