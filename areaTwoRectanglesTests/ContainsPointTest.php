<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/19/14
 */
require_once("areaTwoRectangles.php");

class ContainsPointTest extends PHPUnit_Framework_TestCase
{
    public function testContainsPoint()
    {
        // $r = (0,-5) -> (5, 1), $p = (1, -2); expected result true
        $r = new Rectangle(new Point(0,-5), new Point(5, 1));
        $p = new Point(1, -2);
        $result = Rectangle::containsPoint($r, $p);
        $this->assertTrue($result);

        // $r = (-2, -2) -> (1, 1), $p = (3, 0); expected result false
        $r = new Rectangle(new Point(1, 1), new Point(-2, -2));
        $p = new Point(3, 0);
        $result = Rectangle::containsPoint($r, $p);
        $this->assertFalse($result);
    }
}