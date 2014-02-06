<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/4/14
 * Time: 9:41 AM
 * Copyright Cympel Inc
 */
if($argc > 1) {
    $input = file_get_contents($argv[1]);
    $input_values = explode(PHP_EOL, $input);
    foreach($input_values as $key => $value) {
        echo $value . '\n';
    }

}
