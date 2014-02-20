<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/19/14
 */
require_once("areaTwoRectangles.php");

class SolutionTest extends PHPUnit_Framework_TestCase
{
    public function testSolution()
    {
        // ll1 = (0,0), ur1 = (1,1), ll2 = (2,2), ur2 = (3,3) result = 2 (zero vertex contained scenario)
        $result = solution(0, 0, 1, 1, 2, 2, 3, 3);
        $this->assertEquals(2, $result);

        // ll1 = (0,0), ur1 = (5,5), ll2 = (4,-2), ur2 = (6,1) result = 30 (one vertex contained scenario)
        $result = solution(0, 0, 5, 5, 4, -2, 6, 1);
        $this->assertEquals(30, $result);

        // ll1 = (0,2), ur1 = (6,8), ll2 = (3,3), ur2 = (8,4) result is 42 (two vertices contained scenario)
        $result = solution(0, 2, 6, 8, 3, 3, 9, 5);
        $this->assertEquals(42, $result);

        // ll1 = (-4,-2), ur1 = (2,4), ll2 = (-1,-1), ur2 = (5,1) result = 42 (two vertices contained scenario)
        $result = solution(-4, -2, 2, 4, -1, -1, 5, 1);
        $this->assertEquals(42, $result);

        // ll1 = (0,0), ur1 = (3,3), ll2 = (1,1), ur2 = (2,2) result = 9 (four vertices contained scenario)
        $result = solution(0, 0, 3, 3, 1, 1, 2, 2);
        $this->assertEquals(9, $result);
    }
}