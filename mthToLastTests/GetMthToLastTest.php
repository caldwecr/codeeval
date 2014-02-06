<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/6/14
 * Time: 3:34 PM
 * Copyright Cympel Inc
 */
require_once("mth_to_last.php");

class GetMthToLastTest extends PHPUnit_Framework_TestCase
{
    public function testGetMthToLast()
    {
        // $input = 'a 1'; result = 'a'
        $input = 'a 1';
        $result = getMthToLast($input);
        $this->assertEquals('a', $result);
        // $input = 'a b c d 4'; result = 'a'
        $input = 'a b c d 4';
        $result = getMthToLast($input);
        $this->assertEquals('a', $result);
        // $input = 'e f g h 2'; result = 'g'
        $input = 'e f g h 2';
        $result = getMthToLast($input);
        $this->assertEquals('g', $result);
        // $input = 'k y m 13'; result = false
        $input = 'k y m 13';
        $result = getMthToLast($input);
        $this->assertFalse($result);
    }
}