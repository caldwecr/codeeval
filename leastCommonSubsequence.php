<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/11/14
 * Time: 2:03 PM
 */

if($argc > 1) {
    $input = file_get_contents($argv[1]);
    // Split the lines
    $input_values = explode(PHP_EOL, $input);
    echo doReverseAndAdd($input_values);
}