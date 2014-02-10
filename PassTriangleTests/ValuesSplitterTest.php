<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/10/14
 * Time: 11:35 AM
 * Copyright Cympel Inc
 */
require_once("passTriangle.php");

class ValuesSplitterTest extends PHPUnit_Framework_TestCase
{
    public function testValuesSplitter()
    {
        $values = array(
            0 => '1 2 3 4',
            1 => 'x y z',
        );
        $splitValues = array();
        valuesSpliter($values, $splitValues);
        $this->assertEquals('1', $splitValues[0][0]);
        $this->assertEquals('2', $splitValues[0][1]);
        $this->assertEquals('3', $splitValues[0][2]);
        $this->assertEquals('4', $splitValues[0][3]);

        $this->assertEquals('x', $splitValues[1][0]);
        $this->assertEquals('y', $splitValues[1][1]);
        $this->assertEquals('z', $splitValues[1][2]);
    }
}