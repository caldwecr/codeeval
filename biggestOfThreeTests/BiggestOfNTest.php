<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/21/14
 * Time: 1:48 PM
 */

require_once("biggestOfThree.php");

class BiggestOfNTest extends PHPUnit_Framework_TestCase {
    public function testBiggest()
    {
        // arg list 1, 5, -8, 99, 0, 12, -25, -8, 0, -1, 2000; expected result = 2000
        $result = biggest(1, 5, -8, 99, 0, 12, -25, -8, 0, -1, 2000);
        $this->assertEquals(2000, $result);

        // arg list -12, 5, 5, 12, 12, 13, 12, 0, -99; expected result 13
        $result = biggest(-12, 5, 5, 12, 12, 13, 12, 0, -99);
        $this->assertEquals(13, $result);
    }
}