<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/10/14
 * Time: 12:03 PM
 * Copyright Cympel Inc
 */
require_once("passTriangle.php");

class CalcMaxAdjSumTest extends PHPUnit_Framework_TestCase
{
    public function testCalcMaxAdjSum()
    {
        // values = array(
        // 0 => '5'
        // 1 => '9 6'
        // 2 => '4 6 8'
        // 3 => '0 7 1 5'
        // returns 27
        $values = array(
            0 => '5',
            1 => '9 6',
            2 => '4 6 8',
            3 => '0 7 1 5',
        );
        $result = calcMaxAdjSum($values);
        $this->assertEquals(27, $result);
    }
}