<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/10/14
 * Time: 11:44 AM
 * Copyright Cympel Inc
 */
require_once("passTriangle.php");

class SumRowTest extends PHPUnit_Framework_TestCase
{
    public function testSumRow()
    {
        // Validate that a single row of values is simply copied into the results array
        $rowNumber = 0;
        $values = array(
            0 => array(
                0 => '1',
                1 => '1',
                2 => '3',
            )
        );
        $results = array();
        sumRow($rowNumber, $values, $results);
        $this->assertEquals(1, $results[0][0]);
        $this->assertEquals(1, $results[0][1]);
        $this->assertEquals(3, $results[0][2]);

        // 5
        // 9 6
        // $result = array(0 => array(0 => 14));
        $rowNumber = 0;
        $values = array(
            0 => array(
                0 => '5',
            ),
            1 => array(
                0 => '9',
                1 => '6',
            ),
        );
        $results = array(
            1 => array(
                0 => 9,
                1 => 6,
            ),
        );
        sumRow($rowNumber, $values, $results);
        $this->assertEquals(14, $results[0][0]);
    }
}