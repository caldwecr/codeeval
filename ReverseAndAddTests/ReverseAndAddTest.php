<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/10/14
 * Time: 12:23 PM
 * Copyright Cympel Inc
 */
require_once("reverseAndAdd.php");

class ReverseAndAddTest extends PHPUnit_Framework_TestCase
{
    public function testReverseAndAdd()
    {
        // value = '123'; returns 444
        $value = '123';
        $result = reverseAndAdd($value);
        $this->assertEquals(444, $result);

        // value = '900100'; returns 901109
        $value = '900100';
        $result = reverseAndAdd($value);
        $this->assertEquals(901109, $result);
    }
}