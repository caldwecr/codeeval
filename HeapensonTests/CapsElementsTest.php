<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/3/14
 * Time: 7:59 PM
 */
require_once("heapenson.php");

class CapsElementsTest extends PHPUnit_Framework_TestCase
{
    public function testCapsElements()
    {
        // $foo = '*foo*bar*foobar, expected result *Foo*Bar*Foobar
        $foo = '*foo*bar*foobar';
        capsElements($foo);
        $this->assertEquals('*Foo*Bar*Foobar', $foo);
    }
}