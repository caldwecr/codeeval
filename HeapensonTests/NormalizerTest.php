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

        //        a.btn div#id img.photo
        //        div#id img.photo.bw a.btn.share.link
        // expected outputs: '*a{b}*cd*e{f}, '*cd*e{fg}*a{bhi}
        $foo = 'a.btn div#id img.photo';
        $bar = 'div#id img.photo.bw a.btn.share.link';
        normalizer($foo, $bar);
        $this->assertEquals('*a{b}*cd*e{f}', $foo);
        $this->assertEquals('*cd*e{fg}*a{bhi}', $bar);

        //header.cf.header div.nav-bar div.lc form.search-form fieldset input.search-field
        //header.cf.header div.nav-bar div.lc div.header-social ul.inline-list.social-list.sprite-social
        // expected outputs: '*a{bc}*d{e}*d{f}*g{h}*i*j{k}', '*a{bc}*d{e}*d{f}*d{l}*m{nop}'
        $foo = 'header.cf.header div.nav-bar div.lc form.search-form fieldset input.search-field';
        $bar = 'header.cf.header div.nav-bar div.lc div.header-social ul.inline-list.social-list.sprite-social';
        normalizer($foo, $bar);
        $this->assertEquals('*a{bc}*d{e}*d{f}*g{h}*i*j{k}', $foo);
        $this->assertEquals('*a{bc}*d{e}*d{f}*d{l}*m{nop}', $bar);
    }
}
