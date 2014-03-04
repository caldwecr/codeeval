<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/3/14
 * Time: 8:42 PM
 */
require_once("heapenson.php");

class ReduceToV2Test extends PHPUnit_Framework_TestCase
{
    public function testReduceTo()
    {
        $count = 0;
        $result = reduceToV2('*Ab*C', '*Ab', $count);
        $this->assertEquals(1, $count);

        $count = 0;
        $result = reduceToV2('*Abcd*E', '*E', $count);
        $this->assertEquals(1, $count);

        // $rMe = '*A{bcd}*F', lcs = '*A{bcd}', expected count = 1
        $count = 0;
        $result = reduceToV2('*A{bcd}*F', '*A{bcd}', $count);
        $this->assertEquals(1, $count);

        // $rMe = '*Ab{c}', lcs = '*A', expected count = 2
        $count = 0;
        $result = reduceToV2('*ab{c}', '*a', $count);
        $this->assertEquals(2, $count);

        // $rMe = '*ab{c}', lcs = '*d{e}', expected count = 1
        /*$count = 0;
        $result = reduceTo('*ab{c}', '*{}', $count);
        $this->assertEquals(1, $count); */

        // $rMe = '*Ab*C{d}*Ef{g}', lcs = '*E{g}', expected count = 3
        /* $count = 0;
        $result = reduceTo('*Ab*C{d}*Ef{g}', '*E{g}', $count);
        $this->assertEquals(3, $count); */
    }
}