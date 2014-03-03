<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/3/14
 * Time: 2:02 PM
 */
require_once("heapenson.php");

class ReduceToTest extends PHPUnit_Framework_TestCase
{
    public function testReduceTo()
    {
        /*$count = 0;
        $result = reduceTo('*abcd*e', '*e', $count);
        $this->assertEquals(1, $count);

        // $rMe = '*a{bcd}*f', lcs = '*a{bcd}', expected count = 1
        $count = 0;
        $result = reduceTo('*a{bcd}*f', '*a{bcd}', $count);
        $this->assertEquals(1, $count);

        // $rMe = '*ab{c}', lcs = '*a', expected count = 2
        $count = 0;
        $result = reduceTo('*ab{c}', '*a', $count);
        $this->assertEquals(2, $count);*/

        // $rMe = '*ab{c}', lcs = '*d{e}', expected count = 1
        $count = 0;
        $result = reduceTo('*ab{c}', '*{}', $count);
        $this->assertEquals(1, $count);
    }
}