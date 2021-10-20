<?php declare(strict_types=1);

namespace LuhnApp;

/**
 * Class LuhnAlgorithm
 */
class LuhnAlgorithm
{
    private $input;
    private $errorCount = 0;
    private $errors = [];

    public function __construct ()
    {
        $this->input = (int)$_GET['input'];
        $this->validateInput();
    }

    /**
     * Validate the user input
     */
    public function validateInput ()
    {
        if (empty($this->input)) {
            $this->errorCount++;
            $this->errors[] = "Input can not be empty";
        }

        if (!is_integer($this->input)) {
            $this->errorCount++;
            $this->errors[] = "Input must be a number";
        }

        if (0 === $this->input || 0 > $this->input) {
            $this->errorCount++;
            $this->errors[] = "Input must be greater than 0";
        }

        if (0 === $this->errorCount) {
            $this->runAlgorithm($this->input);
        } else {
            foreach ($this->errors as $error) {
                echo $error . "<br>";
            }
        }
    }

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
            echo $number . " is valid.";
        } else {
            echo $number . " is not valid.";
        }
    }
}

new LuhnAlgorithm();
