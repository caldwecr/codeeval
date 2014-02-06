<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/4/14
 * Time: 10:43 AM
 * Copyright Cympel Inc
 */
require_once("fizzbuzz.php");

class FizzBuzzTest extends PHPUnit_Framework_TestCase
{
    public function testFizzBuzz()
    {
        $a = '3 5 10';
        $b = doFizzBuzz($a);
        $this->assertEquals('1 2 F 4 B F 7 8 F B', $b);


        $a = '2 7 15';
        $b = doFizzBuzz($a);
        $this->assertEquals('1 F 3 F 5 F B F 9 F 11 F 13 FB 15', $b);

        $a = '1 1 5';
        $b = doFizzBuzz($a);
        $this->assertEquals('FB FB FB FB FB', $b);
    }
}