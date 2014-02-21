<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/21/14
 * Time: 1:41 PM
 */

require_once("biggestOfThree.php");

class BiggestOfThreeTest extends PHPUnit_Framework_TestCase
{
    public function testBiggestOfThree()
    {
        // $a = 5, $b = 6, $c = 1; expected result = 6
        $a = 5;
        $b = 6;
        $c = 1;
        $result = biggestOfThree($a, $b, $c);
        $this->assertEquals(6, $result);


        // $a = -5, $b = -5, c = -8; expected result = -5
        $a = -5;
        $b = -5;
        $c = -8;
        $result = biggestOfThree($a, $b, $c);
        $this->assertEquals(-5, $result);
    }
}