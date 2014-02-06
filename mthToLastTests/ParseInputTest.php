<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/6/14
 * Time: 3:11 PM
 * Copyright Cympel Inc
 */
require_once("mth_to_last.php");

class ParseInputTest extends PHPUnit_Framework_TestCase
{
    public function testParseInput()
    {
        // input = a 1; $characters => (1 => 'a'), $index => 1
        $input = 'a 1';
        $characters = array();
        $index = -1;
        parseInput($input, $characters, $index);
        $this->assertEquals('a', $characters[1]);
        $this->assertEquals(1, $index);

        // input = a b c d 4; $characters => (1 => 'd', 2 => 'c', 3 => 'b', 4 => 'a'), $index = 4
        $input = 'a b c d 4';
        $characters = array();
        $index = -1;
        parseInput($input, $characters, $index);
        $this->assertEquals('d', $characters[1]);
        $this->assertEquals('c', $characters[2]);
        $this->assertEquals('b', $characters[3]);
        $this->assertEquals('a', $characters[4]);
        $this->assertEquals(4, $index);

        // input = 'e f g h 2'; $characters => (1 => 'h', 2 => 'g', 3 => 'f', 4 => 'e'), $index = 2
        $input = 'e f g h 2';
        $characters = array();
        $index = -1;
        parseInput($input, $characters, $index);
        $this->assertEquals('h', $characters[1]);
        $this->assertEquals('g', $characters[2]);
        $this->assertEquals('f', $characters[3]);
        $this->assertEquals('e', $characters[4]);
        $this->assertEquals(2, $index);

        // input = 'b c d e 10'; $characters => (1 => 'e', 2 => 'd', 3 => 'c', 4 => 'b'), $index = 10
        $input = 'b c d e 10';
        $characters = array();
        $index = -1;
        parseInput($input, $characters, $index);
        $this->assertEquals('e', $characters[1]);
        $this->assertEquals('d', $characters[2]);
        $this->assertEquals('c', $characters[3]);
        $this->assertEquals('b', $characters[4]);
        $this->assertEquals(10, $index);
    }
}