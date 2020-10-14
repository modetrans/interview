<?php

namespace App\Exceptions;

use Throwable;
use InvalidArgumentException;


/**
 * Exception for Luhn Checksum handling
 */
class LuhnChecksumException extends InvalidArgumentException
{
    /** 
     * 
     * @param string $message
     * @param integer $code
     * @param Throwable|null $previous
     */
    public function __construct($code = 0, ?Throwable $previous = null)
    {
        $message = 'String argument must contain only integer chars.';

        parent::__construct($message, $code, $previous);
    }
}