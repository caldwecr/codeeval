<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/3/14
 * Time: 2:46 PM
 * Copyright Cympel Inc
 */
require_once("ugly.php");

class TernaryNumberConstructTest extends PHPUnit_Framework_TestCase
{
    public function testTernaryNumberConstruct()
    {
        $t = new TernaryNumber();
        $this->assertEquals(13, $t->getNumberOfTerits());

        $t = new TernaryNumber(2);
        $this->assertEquals(2, $t->getNumberOfTerits());
    }
}