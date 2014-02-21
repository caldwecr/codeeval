<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/21/14
 * Time: 2:10 PM
 */

require_once("strstrRedo.php");

class StrstrRedoTest extends PHPUnit_Framework_TestCase {
    public function testStrstrRedo() {
        // $haystack 'fred', $needle 'ed', expected result 2
        $haystack = 'fred';
        $needle = 'ed';
        $result = strstrRedo($haystack, $needle);
        $this->assertEquals(2, $result);

        // $haystack 'd overME1 to go shopping', $needle 'verME1 to g', $result = 3
        $haystack = 'd overME1 to go shopping';
        $needle = 'verME1 to g';
        $result = strstrRedo($haystack, $needle);
        $this->assertEquals(3, $result);

        // $haystack 'tom jones' $needle 'bob smith' $result = -1
        $haystack = 'tom jones';
        $needle = 'bob smith';
        $result = strstrRedo($haystack, $needle);
        $this->assertEquals(-1, $result);

    }
}