<?php

namespace Interview;

use Interview\Exceptions\InvalidNumberException;

class LuhnCheck
{
    public function isValid(string $number): bool
    {
        // Split into characters
        $digits = str_split($number, 1);
        // Extract Checksum
        $checksum = array_pop($digits);
        // Reverse digits
        $digits = array_reverse($digits);
        // Double odd digits
        $doubled = $this->doubleOddPositionedDigits($digits);
        // Substract 9 from all numbers over 9
        $substracted = $this->substractNineOverNine($doubled);
        // Sum all numbers
        $sum = array_sum($substracted);
        $modulus10 = ($sum * 9) % 10;
        return $checksum == $modulus10;
    }
    
    private function doubleOddPositionedDigits(array $digits)
    {
        foreach ($digits as $i => $singleDigit) {
            // If character is not a number then its an invalid number
            if (!is_numeric($singleDigit)) {
//                TODO: Add meaningful message
                throw new InvalidNumberException();
            }
            // Since array positions is based 0, that means that odd positions have an even index
            if ($i % 2 === 0) {
                $digits[$i] = $digits[$i] * 2;
            }
        }
        return $digits;
    }

    private function substractNineOverNine(array $doublesArray)
    {
        foreach ($doublesArray as $idx => $doubled) {
            if ($doubled > 9) {
                $doublesArray[$idx] = $doubled - 9;
            }
        }
        return $doublesArray;
    }
}