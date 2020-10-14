<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Interfaces\LuhnChecksumInterface;
use App\Exceptions\LuhnChecksumException;

/**
 * Service to perform Luhn Checksum handling and validation.
 * This service expects input as a string due to source being a URL.
 */
class LuhnChecksumService implements LuhnChecksumInterface
{

    /**
     * Determine whether subject string is a valid Luhn checksum
     *
     * @param string $subject
     * @return boolean
     */
    public function handle(string $subject): bool
    {
        $this->validate($subject);

        // Luhn Checksum algorithm
        $total = 0;
        $length = mb_strlen($subject);
        for ($i = 0; $i < $length; $i++) {
            // get the current character in the string
            $char = intval($subject[$i]);
            // grab every other digit
            if ($i % 2) {
                // left shift by 1 place is multiply by 2, but slightly faster
                $char = $char << 1;
                if ($char > 9) {
                    // add result digits together (like numerology)
                    $char = ($char % 10) + 1;
                }
            }
            // sum all the digits
            $total += $char;
        }
        // valid numbers have digits that sum to a number ending in 0
        return $total % 10 === 0;
    }

    /**
     * Validate subject string contains integer value
     *
     * @param string $subject
     * @return void
     */
    private function validate(string $subject): void
    {
        $int = (int) $subject;

        if (0 === $int) {
            throw new LuhnChecksumException;
        }
    }
}