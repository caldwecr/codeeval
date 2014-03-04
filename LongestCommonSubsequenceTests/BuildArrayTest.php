<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/3/14
 * Time: 6:54 PM
 */
require_once("longestCommonSubsequence.php");

class BuildArrayTest extends PHPUnit_Framework_TestCase
{
    public function testBuildArray()
    {
        $left = 'abc';
        $right = 'de';
        buildArray($left, $right, $arr);
        //var_dump($arr);
        $this->assertEquals(3 + 1, count($arr));
        $this->assertEquals(2 + 1, count($arr[0]));
    }
}