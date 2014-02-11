<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/11/14
 * Time: 2:54 PM
 */
require_once("longestCommonSubsequence.php");

class GetLCSTest extends PHPUnit_Framework_TestCase
{
    public function testGetLCS()
    {
        // Verify that if $left or $right are empty the method returns ''
        $left = '';
        $right = 'abc';
        $result = 'z';
        $result = getLCS($left, $right);
        $this->assertEquals('', $result);

        $left = '123';
        $right = '';
        $result = 'z';
        $result = getLCS($left, $right);
        $this->assertEquals('', $result);

        // Verify the scenarios where $left or $right are only one char
        $left = 'a';
        $right = 'bcd';
        $result = 'z';
        $result = getLCS($left, $right);
        $this->assertEquals('', $result);
        $result = 'z';
        $result = getLCS($right, $left);
        $this->assertEquals('', $result);

        $left = 'd';
        $right = 'abd';
        $result = 'z';
        $result = getLCS($left, $right);
        $this->assertEquals('d', $result);
        $result = 'z';
        $result = getLCS($right, $left);
        $this->assertEquals('d', $result);

        // Whiteboard case one $left = 'abbe' $right = 'baebee' $result = 'abe'
        $left = 'abbe';
        $right = 'zaebee';
        $result = getLCS($left, $right);
        $this->assertEquals('abe', $result);

        // Whiteboard case two $left = 'zkfyj' $right = 'fyjkzp' $result = 'fyj'
        $left = 'zkfyj';
        $right = 'fyjkzp';
        $result = getLCS($left, $right);
        $this->assertEquals('fyj', $result);
    }
}