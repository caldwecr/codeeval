<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/19/14
 */
require_once("areaTwoRectangles.php");

class GetAreaTest extends PHPUnit_Framework_TestCase
{
    public function testGetArea()
    {
        //p1 = (0, 0), p2 = (5, -5), expected result = 25
        $p1 = new Point(0, 0);
        $p2 = new Point(5, -5);
        $r = new Rectangle($p1, $p2);
        $result = $r->getArea();
        $this->assertEquals(25, $result);

        //p1 = (0, 0), p2 = (0, 0), expected result = 0
        $p1 = new Point(0, 0);
        $p2 = new Point(0, 0);
        $r = new Rectangle($p1, $p2);
        $result = $r->getArea();
        $this->assertEquals(0, $result);
    }
}