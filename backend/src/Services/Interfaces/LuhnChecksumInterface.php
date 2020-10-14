<?php

namespace App\Services\Interfaces;

/**
 * Contract for Luhn Checksum handler
 */
interface LuhnChecksumInterface
{

    /**
     *
     * @param string $subject
     * @return boolean
     */
    public function handle(string $subject): bool;
}