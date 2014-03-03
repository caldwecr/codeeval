<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/3/14
 * Time: 2:12 PM
 */
require_once("heapenson.php");

class HeapensonTest extends PHPUnit_Framework_TestCase
{
    public function testHeapenson()
    {
        //$h1 = 'div', $h2 = 'div', result = 0
        $h1 = 'div';
        $h2 = 'div';
        $result = heapenson($h1, $h2);
        $this->assertEquals(0, $result);

        //$h1 = 'div#id', $h2 = 'div#id', result = 0
        $h1 = 'div#id';
        $h2 = 'div#id';
        $result = heapenson($h1, $h2);
        $this->assertEquals(0, $result);

        //$h1 = 'div#id.cls.btn', $h2 = 'div#id.btn.cls', result = 0
        $h1 = 'div#id.cls.btn';
        $h2 = 'div#id.btn.cls';
        $result = heapenson($h1, $h2);
        $this->assertEquals(0, $result);

        //$h1 = 'div#id', $h2 = 'div', result = 1
        $h1 = 'div#id';
        $h2 = 'div';
        $result = heapenson($h1, $h2);
        $this->assertEquals(1, $result);

        //$h1 = 'div#id.btn' $h2 = 'div', result = 2
        $h1 = 'div#id.btn';
        $h2 = 'div';
        $result = heapenson($h1, $h2);
        $this->assertEquals(2, $result);

        //$h1 = 'div#id.btn', $h2 = 'a.blue', result = 3
        $h1 = 'div#id.btn';
        $h2 = 'a.blue';
        $result = heapenson($h1, $h2);
        $this->assertEquals(3, $result);
    }
}