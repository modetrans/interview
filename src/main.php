<?php

declare(strict_types=1);

use App\LuhnValidator;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$stdin = fopen('php://stdin', 'r');
$done = false;

$luhnValidator = new LuhnValidator();

while (!$done) {
    echo "\e[39mPlease enter a single Luhn number to validate: (enter \"q\" to exit) ";
    $input = trim(fgets($stdin));

    if ($input === 'q') {
        fclose($stdin);
        $done = true;
    } else {
        echo $luhnValidator->checkLuhn($input)
            ? sprintf('%s is %s', $input, "\e[32mvalid\e[39m.\n")
            : sprintf('%s is %s', $input, "\e[31mnot valid\e[39m.\n");
    }
}
