<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/6/14
 * Time: 4:08 PM
 * Copyright Cympel Inc
 */
require_once("doubleSquares.php");

class DijkstraDoubleSquaresTest extends PHPUnit_Framework_TestCase
{
    public function testDijkstraDoubleSquares()
    {
        // $value = 10; $result = 1
        $value = 10;
        $result = calculateNumberOfDoubleSquaresDijkstra($value);
        $this->assertEquals(1, $result);

        // $value = 25; $result = 2
        $value = 25;
        $result = calculateNumberOfDoubleSquaresDijkstra($value);
        $this->assertEquals(2, $result);

        // $value = 3; $result = 0
        $value = 3;
        $result = calculateNumberOfDoubleSquaresDijkstra($value);
        $this->assertEquals(0, $result);

        // $value = 0; $result = 1
        $value = 0;
        $result = calculateNumberOfDoubleSquaresDijkstra($value);
        $this->assertEquals(1, $result);

        // $value = 1; $result = 1
        $value = 1;
        $result = calculateNumberOfDoubleSquaresDijkstra($value);
        $this->assertEquals(1, $result);

        // $value = 123456789; validate that it finishes
        $value = 123456789;
        $result = calculateNumberOfDoubleSquaresDijkstra($value);
        $this->assertNotNull($result);

        // $value = 2147483647; validate that it finishes
        $value = 2147483647;
        $result = calculateNumberOfDoubleSquaresDijkstra($value);
        $this->assertNotNull($result);
        var_dump($result);
    }
}