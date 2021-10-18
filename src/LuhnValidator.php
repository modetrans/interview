<?php

declare(strict_types=1);

namespace App;

class LuhnValidator
{
    /**
     * Checks if input is a valid Luhn number.
     * @param string $s The number to validate.
     * @return bool true if number is valid Luhn, otherwise returns false.
     */
    public function checkLuhn(string $s): bool
    {
        if ('' === $s || is_numeric($s) === false) {
            return false;
        }

        $length = strlen($s);
        $sum = 0;
        $parity = ($length-1) % 2;

        for ($i=$length-1; $i >= 0; $i--) {
            $digit = (int)$s[$i];
            if ($i % 2 !== $parity) {
                $digit = $digit << 1; //Shift the bits of $digit 1 step to the left (each step means "multiply by two")
                if ($digit > 9) {
                    $digit = array_sum(str_split((string)$digit));
                }
            }
            $sum += $digit;
        }
        return ($sum % 10) === 0;
    }
}
