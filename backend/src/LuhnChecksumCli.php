<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use Interview\Exceptions\InvalidNumberException;
use Interview\LuhnCheck;

try {
    if (!isset($argv[1])) {
        throw new InvalidNumberException("Invalid number, none provided");
    }

    $number = $argv[1];

    $checker = new LuhnCheck();
    $isValid = $checker->isValid($number);
    if ($isValid) {
        echo "$number is valid.\n";
    } else {
        echo "$number is not valid.\n";
    }
} catch (InvalidNumberException $e) {
    echo $e->getMessage() . "\n";
    return 1;
}