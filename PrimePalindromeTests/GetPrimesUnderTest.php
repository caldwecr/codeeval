<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/11/14
 * Time: 4:28 PM
 */
require_once("primePalindrome.php");

class GetPrimesUnderTest extends PHPUnit_Framework_TestCase
{
    public function testGetPrimesUnder()
    {
        // ceiling = 19 result = array(2, 3, 5, 7, 11, 13, 17)
        $ceiling = 19;
        $result = getPrimesUnder($ceiling);
        $this->assertEquals(2, $result[0]);
        $this->assertEquals(3, $result[1]);
        $this->assertEquals(5, $result[2]);
        $this->assertEquals(7, $result[3]);
        $this->assertEquals(11, $result[4]);
        $this->assertEquals(13, $result[5]);
        $this->assertEquals(17, $result[6]);

    }
}