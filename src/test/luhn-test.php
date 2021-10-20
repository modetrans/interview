<?php declare(strict_types=1);

namespace LuhnApp;

class LuhnAlgorithm
{
    /**
     * Run Luhn Algorithm
     * @param $number
     */
    public function runAlgorithm ($number)
    {
        settype($number, 'string');
        $number = preg_replace("/[^0-9]/", "", $number);
        $numberCheck = '';
        $reversedArray = str_split(strrev($number));
        foreach ($reversedArray as $int => $digit) {
            $numberCheck .= (($int % 2) !== 0) ? (string)((int)$digit * 2) : $digit;
        }
        $sum = array_sum(str_split($numberCheck));

        if (($sum % 10) === 0) {
            return true;
        } else {
            return false;
        }
    }
}

// Add values as necessary for further testing
$values = [
    '10',
    '25',
    '26',
    '27',
];

$luhnValidator = new LuhnAlgorithm();

// Test each value
foreach($values as $test) {
    if($luhnValidator->runAlgorithm($test)) {
        echo $test . " is valid.\n";
    } else {
        echo $test . " is not valid.\n";
    }
}
