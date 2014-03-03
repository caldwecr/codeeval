<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/3/14
 * Time: 1:24 PM
 */
require_once("heapenson.php");

class NormalizerTest extends PHPUnit_Framework_TestCase
{
    public function testNormalizer()
    {
        // inputs: foo = div#chick.banana.taco ul,  bar = ul div#chick
        // expected outputs: foo = *ab{cd}*e, bar = *e*ab
        $foo = 'div#chick.banana.taco ul';
        $bar = 'ul div#chick';
        normalizer($foo, $bar);
        $this->assertEquals('*ab{cd}*e', $foo);
        $this->assertEquals('*e*ab', $bar);


        // inputs foo = div, bar = div
        // expected outputs: foo = *a, bar = *a
        $foo = 'div';
        $bar = 'div';
        normalizer($foo, $bar);
        $this->assertEquals('*a', $foo);
        $this->assertEquals('*a', $bar);

        // inputs foo = 'div#id.cls.btn', bar = 'div#id.btn.cls'
        // expected outputs: foo = *ab{cd}, bar = *ab{dc}
        $foo = 'div#id.cls.btn';
        $bar = 'div#id.btn.cls';
        normalizer($foo, $bar);
        $this->assertEquals('*ab{cd}', $foo);
        $this->assertEquals('*ab{dc}', $bar);

    }
}
