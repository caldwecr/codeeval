<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/6/14
 * Time: 3:51 PM
 * Copyright Cympel Inc
 */
if($argc > 1) {
    $input = file_get_contents($argv[1]);
    // Split the lines
    $input_values = explode(PHP_EOL, $input);
    echo runDoubleSquares($input_values);
}

function runDoubleSquares($input_values)
{
    $numberOfTestCases = $input_values[0];
    unset($input_values[0]);
    $toReturn = '';
    foreach($input_values as $key => $value) {
        $toReturn .= calculateNumberOfDoubleSquaresDijkstra($value) . "\n";
    }
    return $toReturn;
}


/**
 * @param int $value
 * @return int
 *
 * Credit given to Edsgar Dijkstra re: @link http://stackoverflow.com/questions/19339987/double-squares-facebook-hacker-cup-2011-in-java
 */
function calculateNumberOfDoubleSquaresDijkstra($value)
{
    // Find integer square root
    $sqrt = (int) sqrt((int) $value);

    // Define x, y, and total and instantiate with initial values
    $x = $sqrt;
    $y = 0;
    $total = 0;

    while($x >= $y) {
        $leftSide = $x * $x + $y * $y;
        if($leftSide < $value) {
            $y++;
        } else if($leftSide > $value) {
            $x--;
        } else if($leftSide == $value) {
            $total++;
            $x--;
            $y++;
        }
    }
    return $total;
}