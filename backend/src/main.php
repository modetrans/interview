<?php

/**
 * This script takes a single number checks its validity against the Luhn Checksum.
 * Usage on command line: php main.php 79927398713
 */

require(__DIR__ . '/LuhnValidator.php');

use ModeTrans\LuhnValidator;

// Get the provided argument and feed it into the LuhnValidator
$input = trim($argv[1] ?? null);
$luhn = new LuhnValidator($input);

if ($luhn->isValid()) {
    echo "$input is valid.\n";
    exit(0);
} else {
    $error = '';

    if ($input || $input === '0') {
        $error = "$input is not valid.";
    }

    if ($luhn->getError()) {
        $error .= " {$luhn->getError()}";
    }

    echo "$error\n";
    exit(1);
}
