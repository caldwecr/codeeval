<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/10/14
 * Time: 12:36 PM
 * Copyright Cympel Inc
 */
require_once("reverseAndAdd.php");

class DoReverseAndAddTest extends PHPUnit_Framework_TestCase
{
    public function testDoReverseAndAdd()
    {
        // valuesArray = array( 0 => '195' ) returns '4 9339'
        $valuesArray = array(
            0 => '195',
        );
        $result = doReverseAndAdd($valuesArray);
        $this->assertEquals('4 9339' . "\n", $result);
    }
}