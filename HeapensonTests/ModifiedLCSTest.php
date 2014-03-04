<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/4/14
 * Time: 11:56 AM
 */
require_once("heapenson.php");

class ModifiedLCSTest extends PHPUnit_Framework_TestCase
{
    public function testLCS()
    {
        // $foo = '*Ab{cd}*Ef', $bar = '*Ef{gh}', expected result = '*Ef'
        $foo = '*Ab{cd}*Ef';
        $bar = '*Ef{gh}';
        $result = getLCSDynamicProgramming($foo, $bar);
        $this->assertEquals('*Ef', $result);

        // $foo = '*Ab{cd}*Ef', $bar = '*A{cg}', expected result = '*A{c}'
        $foo = '*Ab{cd}*Ef';
        $bar = '*A{cg}';
        $result = getLCSDynamicProgramming($foo, $bar);
        $this->assertEquals('*A{c}', $result);

    }
}