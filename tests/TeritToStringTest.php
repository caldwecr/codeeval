<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/3/14
 * Time: 2:37 PM
 * Copyright Cympel Inc
 */
require_once("ugly.php");

class TeritToStringTest extends PHPUnit_Framework_TestCase
{
    public function testTeritToString()
    {
        $t = new TernaryNumber();
        //echo $t->toString();
        $this->assertEquals(0, $t->toInt());
        $t->incrementTerit(0);
        //echo $t->toString();
        $this->assertEquals(1, $t->toInt());
        $t->incrementTerit(0);
        $t->incrementTerit(0);
        $t->incrementTerit(0);
        $t->incrementTerit(0);
        $this->assertEquals(5, $t->toInt());
        echo $t->toString();
        $this->assertTrue(true);
    }
}