<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/3/14
 * Time: 12:41 PM
 * Copyright Cympel Inc
 */
require_once("ugly.php");

class MagicEvalTest extends PHPUnit_Framework_TestCase
{
    public function testMagicEval()
    {
        $digits = array(0 => 1);
        $operators = array();
        $this->assertEquals(1, Evaler::magicEval($digits, $operators));

        $digits = array(
            0 => 0,
            1 => 3,
            2 => 5
        );
        $operators = array(
            1 => '+',
            2 => '+',
        );
        $this->assertEquals(8, Evaler::magicEval($digits, $operators));

        $digits = array(
            0 => 5,
            1 => 6,
        );
        $operators = array(
            1 => '-',
        );
        $this->assertEquals(-1, Evaler::magicEval($digits, $operators));

        $digits = array(
            0 => 2,
            1 => 1,
            2 => 9,
        );
        $operators = array(
            1 => 'no',
            2 => 'no',
        );
        $this->assertEquals(219, Evaler::magicEval($digits, $operators));

        $digits = array(
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 4,
            4 => 5,
            5 => 6,
        );
        $operators = array(
            1 => '+',
            2 => 'no',
            3 => 'no',
            4 => '-',
            5 => '+',
        );
        $this->assertEquals(236, Evaler::magicEval($digits, $operators));

        // 123 + 4 - 56 = 71
        $digits = array(
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 4,
            4 => 5,
            5 => 6,
        );
        $operators = array(
            1 => 'no',
            2 => 'no',
            3 => '+',
            4 => '-',
            5 => 'no',
        );
        $this->assertEquals(71, Evaler::magicEval($digits, $operators));
    }
}