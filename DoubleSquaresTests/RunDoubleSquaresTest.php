<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/6/14
 * Time: 3:54 PM
 * Copyright Cympel Inc
 */
require_once("doubleSquares.php");

class RunDoubleSquaresTest extends PHPUnit_Framework_TestCase
{
    public function testRunDoubleSquares()
    {
        $input_values = array(
            5,
            10,
            25,
            3,
            0,
            1,
        );
        $response =
            "1\n2\n0\n1\n1\n";
        $result = runDoubleSquares($input_values);
        $this->assertEquals($response, $result);
    }
}