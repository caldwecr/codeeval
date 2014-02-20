<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/19/14
 */
require_once("areaTwoRectangles.php");

class GetIntersectingRectangleForTwoPointsTest extends PHPUnit_Framework_TestCase
{
    public function testGetIntersectingRectangleForTwoPointsTest()
    {
        $r = new Rectangle(new Point(0, 0), new Point(5, 5));
        $ll = new Point(1, 1);
        $ul = new Point(1, 2);
        $pointsInside = array('ll' => $ll, 'ul' => $ul);
        $containingRectangle = Rectangle::getIntersectingRectangleForTwoPoints($pointsInside, $r);
        $this->assertEquals(1, $containingRectangle->getMinX());
        $this->assertEquals(1, $containingRectangle->getMinY());
        $this->assertEquals(5, $containingRectangle->getMaxX());
        $this->assertEquals(2, $containingRectangle->getMaxY());
        $this->assertEquals(4, $containingRectangle->getArea());


        $r = new Rectangle(new Point(-7, -6), new Point(-1, -2));
        $ul = new Point(-4, -3);
        $ur = new Point(-3, -2);
        $pointsInside = array('ul' => $ul, 'ur' => $ur);
        $containingRectangle = Rectangle::getIntersectingRectangleForTwoPoints($pointsInside, $r);
        $this->assertEquals(-4, $containingRectangle->getMinX());
        $this->assertEquals(-6, $containingRectangle->getMinY());
        $this->assertEquals(-3, $containingRectangle->getMaxX());
        $this->assertEquals(-2, $containingRectangle->getMaxY());
    }
}