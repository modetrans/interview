<?php

class LuhnValidator
{
	private $input;
	private $error;

	public function __construct($input)
	{
		$this->input = trim($input);
	}

	public function isValid(): bool
	{
		return $this->inputIsValid() && $this->luhnCheck();
	}

    /**
     * Validates that $input is a proper, whole number.
     *
     * @return bool
     */
	public function inputIsValid(): bool
	{
		if(!$this->input) {
			$this->error = 'Please provide a number of at least 2 digits to validate.';
			return false;
		}

		// Test if there are enough characters
		if(mb_strlen($this->input) < 2) {
			$this->error = 'Your number must have at least 2 digits.';
			return false;
		}

		// Test if input contains any non-numeric characters
		if(!preg_match('/^\d+$/', $this->input)) {
			$this->error = 'Your input is not a whole number.';
			return false;
		}

		return true;
	}

    /**
     * Validates $input against the Luhn checksum.
     *
     * @return bool
     */
	public function luhnCheck(): bool
	{
		// Convert number into an array so we can iterate through the digits
		$arr = str_split($this->input);

		// The check digit is the rightmost number
		$check = (int) array_pop($arr);

		// Reverse the array to iterate through it from the "right"
		$arr = array_reverse($arr);

		// Double every second number
		foreach($arr as $i => $digit) {
			$digit = (int) $digit;

			if($i % 2 === 0) {
				$digit *= 2;

				// If number consists of multiple digits, sum those digits
				// 12 becomes 1 + 2 which yields 3
				if($digit >= 10) {
					$digit = array_sum(str_split($digit));
				}

			}

			// Replace the number in the original array. Odd numbers don't need
			// to be replaced here, but this way they all end up integers
			// instead of becoming a mix of strings and ints.
			$arr[$i] = $digit;
		}

		// Get sum of all the numbers
		$fullSum = array_sum($arr);

		// Final test
		return 10 - ($fullSum % 10) === $check;
	}

	public function getError(): ?string
	{
		return $this->error;
	}
}