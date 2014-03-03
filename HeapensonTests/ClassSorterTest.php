<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/3/14
 * Time: 2:43 PM
 */
require_once("heapenson.php");

class ClassSorterTest extends PHPUnit_Framework_TestCase
{
    public function testClassSorter()
    {
        // $foo in = '*a{defb}*j' $foo out expected = '*a{bdef}*j'
        $foo = '*a{defb}*j';
        classSorter($foo);
        $this->assertEquals('*a{bdef}*j', $foo);
    }
}