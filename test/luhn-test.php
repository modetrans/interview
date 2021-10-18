<?php

declare(strict_types=1);

use App\LuhnValidator;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$luhnValidator = new LuhnValidator();

$numbers = "49927398716 49927398717 1234567812345678 1234567812345670 badstring";

foreach (explode(' ', $numbers) as $n) {
    echo $luhnValidator->checkLuhn($n)
        ? sprintf('%s is %s', $n, "\e[32mvalid\e[39m.\n")
        : sprintf('%s is %s', $n, "\e[31mnot valid\e[39m.\n");
}
