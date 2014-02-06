<?php

class TernaryNumber {
    /**
     * @var array
     * A terit is the made up name I gave to the ternary equivalent of a bit
     */
    protected $terits;

    /**
     * @param int $numberOfTerits
     */
    public function __construct($numberOfTerits = 13)
    {
        $this->terits = array();
        for($i = 0; $i < $numberOfTerits; $i++) {
            $this->terits[$i] = 0;
        }
    }

    /**
     * @return int
     */
    public function getNumberOfTerits()
    {
        return count($this->terits);
    }

    /**
     * @param int $index
     * @return int
     */
    public function getTerit($index) {
        return $this->terits[$index];
    }

    /**
     * @return array
     */
    public function getTerits()
    {
        return $this->terits;
    }

    /**
     * @param int $index
     * @param int $value
     * @todo add parameter validation
     */
    public function setTerit($index, $value) {
        $this->terits[$index] = $value;
    }

    /**
     * @param int $index
     * @todo add parameter validation
     */
    public function incrementTerit($index) {
        if($this->terits[$index] < 2) {
            $this->terits[$index]++;
        } else {
            $this->terits[$index] = 0;
            $this->incrementTerit($index+1);
        }
    }

    /**
     * Equivalent to ++
     */
    public function plusplus()
    {
        $this->incrementTerit(0);
    }

    /**
     * @return int
     *
     * Returns the base10 representation of the TernaryNumber
     */
    public function toInt()
    {
        $toReturn = 0;
        foreach($this->terits as $key => $terit) {
            $toReturn += pow(3, $key) * $terit;
        }
        return $toReturn;
    }

    /**
     * @return string
     * Display a string representation of the TernaryNumber's terits
     */
    public function toString()
    {
        $toReturn = '';
        foreach($this->terits as $key => $terit) {
            $toReturn .= "Key = {$key}, Value = {$terit}\n\r";
        }
        return $toReturn;
    }
}

/**
 * If there is a parameter it should be the file name to read the input from
 */
if($argc > 1) {
    $input = file_get_contents($argv[1]);
    $input_values = explode(PHP_EOL, $input);


    foreach($input_values as $key => $value) {
        $numberOfLeadingZeroes = 0;
        $trimmedValue = trimmer($value, $numberOfLeadingZeroes);
        echo pow(3, $numberOfLeadingZeroes) * UglyCounter::countUgly($trimmedValue) . "\n";
    }
    /*echo "Count below Threshold = " . Evaler::getCountBelowThreshold() . "\n";
    echo "Count above threshold = " . Evaler::getCountOverThreshold() . "\n";*/
}

function trimmer($value, &$trimmedCount)
{
    if(strpos($value, '00') === 0) {
        return trimmer(substr($value, 1), ++$trimmedCount);
    }
    return $value;
}

/**
 * @param $value
 * @return bool
 *
 * Returns true is the parameter is considered 'ugly'
 */
function isUgly($value)
{
    $valueAsInt = (int) $value;
    if($valueAsInt % 2 === 0) return true;
    if($valueAsInt % 3 === 0) return true;
    if($valueAsInt % 5 === 0) return true;
    if($valueAsInt % 7 === 0) return true;
    return false;
}
class UglyCounter {
    /**
     * @var array
     */
    static protected $knownCounts = array(

    );

    /**
     * @param string $value
     * @return int
     */
    public static function countUgly($value)
    {
        if(array_key_exists($value,self::$knownCounts)) {
            return self::$knownCounts[$value];
        }
        // Split the string into char array
        $digits = str_split($value);
        $operators = array();
        $uglyCount = 0;
        $numDigits = count($digits);
        $t = new TernaryNumber($numDigits - 1);
        $maxOperatorPermutations = pow(3, $numDigits - 1);

        // Added to improve performance
        $tt = $t->toInt();
        while($tt < $maxOperatorPermutations) {
            $terits = $t->getTerits();
            foreach($digits as $key => $digit) {
                if($key === 0) {
                    // don't do anything
                } else {
                    // This is because operators's keys correspond to the key of the right side digit
                    //$terit = $t->getTerit($key - 1);
                    $terit = $terits[$key - 1];
                    if($terit === 0) {
                        $operators[$key] = 'no';
                    } else if($terit === 1) {
                        $operators[$key] = '+';
                    } else {
                        $operators[$key] = '-';
                    }
                }
            }
            if(isUgly(Evaler::magicEval($digits, $operators))) {
                $uglyCount++;
            }
            $t->plusplus();
            $tt++;
        }
        self::$knownCounts[$value] = $uglyCount;


        return $uglyCount;
    }
}

/**
 * @param array $digits
 * @param array $operators
 */
function processNullOperators(&$digits, &$operators)
{
    $lastValidKey = -1;
    $newDigits = array();
    $newOperators = array();
    foreach($digits as $digitKey => $digit) {
        //var_dump('test');
        if($digitKey === 0) {
            $newDigits[$digitKey] = $digit;
            $lastValidKey = $digitKey;
        } else if($operators[$digitKey] === 'no') {
            $newDigits[$lastValidKey] = nullOperator($newDigits[$lastValidKey], $digit);

        } else {
            $newDigits[$digitKey] = $digit;
            $newOperators[$digitKey] = $operators[$digitKey];
            $lastValidKey = $digitKey;
        }
    }
    $digits = $newDigits;
    $operators = $newOperators;
}

class Evaler {
    /*protected static $countOfEvalsBelowThreshold = 0;
    protected static $countOfEvalsOverThreshold = 0;
    protected static $threshold = 50;*/

    /**
     * @param array $digits
     * @param array $operators
     * @return int
     */
    public static function magicEval($digits = array(), $operators = array())
    {
        processNullOperators($digits, $operators);
        // Skip eval (just return 2) if the set of digits will be even
        // array_sum turned out to be slower than foreach in testing
        //$digitSum = array_sum($digits);
        $digitSum = 0;
        foreach($digits as $digitKey => $digit) {
            $digitSum+= $digit;
        }
        if($digitSum % 2 === 0) {
            return 2;
        }/* else if((count($digits) - 1) % 2 === 1) {
            // If the digit sum is odd, but the number of + and - operators is also odd, then the evaluation will be an even number,
            // since we've already removed the no's we can determine the number of + / - by subtracting 1 from the number of digits

            // This isn't true
            return 2;
        }*/
        $result = $digits[0];
        foreach($digits as $digitKey => $digit) {
            if($digitKey > 0) {
                if($operators[$digitKey] == '+') {
                    $result = sum($result, $digit);
                } else if($operators[$digitKey] == '-') {
                    $result = difference($result, $digit);
                }
            }
        }
        /*if($result <= self::$threshold) {
            self::$countOfEvalsBelowThreshold++;
        } else {
            self::$countOfEvalsOverThreshold++;
        }*/
        return $result;
    }

    /*public static function getCountBelowThreshold()
    {
        return self::$countOfEvalsBelowThreshold;
    }

    public static function getCountOverThreshold()
    {
        return self::$countOfEvalsOverThreshold;
    }*/
}
/**
 * @param int $left
 * @param int $right
 * @return int
 */
function sum($left, $right)
{
    return $left + $right;
}

/**
 * @param int $left
 * @param int $right
 * @return int mixed
 */
function difference($left, $right)
{
    return $left - $right;
}

/**
 * @param int $left
 * @param int $right
 * @return int
 */
function nullOperator($left, $right)
{
    return 10*$left + $right;
}