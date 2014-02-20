<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/19/14
 * Time: 5:41 PM
 */
require_once("areaTwoRectangles.php");

class DistanceBetweenTwoPointsTest extends PHPUnit_Framework_TestCase
{
    public function testDistanceBetweenTwoPoints()
    {
        //p1 = (0, 0), p2 = (3, 4), expected result 5
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $result = Point::distanceBetweenTwoPoints($p1, $p2);
        $this->assertEquals(5, $result);

        //p1 = (-5, 20), p2 = (-5, 20), expected result 0
        $p1 = new Point(-5, 20);
        $p2 = new Point(-5, 20);
        $result = Point::distanceBetweenTwoPoints($p1, $p2);
        $this->assertEquals(0, $result);

        //p1 = (-1, -3), p2 = (2, 1), expected result 5
        $p1 = new Point(-1, -3);
        $p2 = new Point(2, 1);
        $result = Point::distanceBetweenTwoPoints($p1, $p2);
        $this->assertEquals(5, $result);
    }
}