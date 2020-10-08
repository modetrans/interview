<?php

namespace Interview;

use Interview\Exceptions\InvalidNumberException;

class LuhnCheck
{
    public function isValid($number)
    {
        throw new InvalidNumberException();
    }
}