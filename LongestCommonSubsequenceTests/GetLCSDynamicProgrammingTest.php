<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/11/14
 * Time: 2:54 PM
 */
require_once("longestCommonSubsequence.php");

class GetLCSDynamicProgrammingTest extends PHPUnit_Framework_TestCase
{
    public function testGetDPLCS()
    {
        // Verify that if $left or $right are empty the method returns ''
        $left = '';
        $right = 'abc';
        $result = 'z';
        $result = getLCSDynamicProgramming($left, $right);
        $this->assertEquals('', $result);

        $left = '123';
        $right = '';
        $result = 'z';
        $result = getLCSDynamicProgramming($left, $right);
        $this->assertEquals('', $result);

        // Verify the scenarios where $left or $right are only one char
        $left = 'a';
        $right = 'bcd';
        $result = 'z';
        $result = getLCSDynamicProgramming($left, $right);
        $this->assertEquals('', $result);
        $result = 'z';
        $result = getLCSDynamicProgramming($right, $left);
        $this->assertEquals('', $result);

        $left = 'd';
        $right = 'abd';
        $result = 'z';
        $result = getLCSDynamicProgramming($left, $right);
        $this->assertEquals('d', $result);
        $result = 'z';
        $result = getLCSDynamicProgramming($right, $left);
        $this->assertEquals('d', $result);

        // Whiteboard case one $left = 'abbe' $right = 'baebee' $result = 'abe'
        $left = 'abbe';
        $right = 'zaebee';
        $result = getLCSDynamicProgramming($left, $right);
        $this->assertEquals('abe', $result);

        // Whiteboard case two $left = 'zkfyj' $right = 'fyjkzp' $result = 'fyj'
        $left = 'zkfyj';
        $right = 'fyjkzp';
        $result = getLCSDynamicProgramming($left, $right);
        $this->assertEquals('fyj', $result);

        // Performance test case
        $left = 'div#nav-col.billboard-layout.cf.main-row div#yui_3_8_1_1_1382751082490_1382.main-col-wrapper div#hero-col.main-col1 div#yui_3_8_1_1_1382751082490_1381.hero-col-wrapper div#stream div#default-p_30345786.mod.view_default div#default-p_30345786-bd.bd.type_stream.type_stream_default ul#yui_3_8_1_1_1382751082490_1533 li#yui_3_8_1_1_1382751082490_1718.cf.content.has-image.voh-parent div#yui_3_8_1_1_1382751082490_1717.cf.wrapper div#yui_3_8_1_1_1382751082490_1716.body div#yui_3_8_1_1_1382751082490_1715.body-wrap p#yui_3_8_1_1_1382751082490_1740.mt-xxs.summary';
        $right = 'div#nav-col.billboard-layout.cf.main-row div#yui_3_8_1_1_1382751082490_1382.main-col-wrapper div#hero-col.main-col1 div#yui_3_8_1_1_1382751082490_1381.hero-col-wrapper div#stream div#default-p_30345786.mod.view_default div#default-p_30345786-bd.bd.type_stream.type_stream_default ul#yui_3_8_1_1_1382751082490_1533 li#yui_3_8_1_1_1382751082490_1532.cf.content.voh-parent div#yui_3_8_1_1_1382751082490_1531.cf.wrapper div#yui_3_8_1_1_1382751082490_1530.body div#yui_3_8_1_1_1382751082490_1529.body-wrap p#yui_3_8_1_1_1382751082490_1554.mt-xxs.summary';
        $result = getLCSDynamicProgramming($left, $right);
        $this->assertEquals(1, 1);
    }
}