<?php

namespace Interview\Tests;

use Interview\Exceptions\InvalidNumberException;
use Interview\LuhnCheck;
use PHPUnit\Framework\TestCase;

class LuhnCheckTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new LuhnCheck();
    }

    /**
     * @dataProvider provideNumberWithValidity
     */
    public function testNumbersValidity($number, $expectedResult)
    {
        $this->assertFalse(false);
        $actualResult = $this->sut->isValid($number);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testThrowExceptionIfNotNumericStringProvided()
    {
        $this->expectException(InvalidNumberException::class);
        $this->sut->isValid('Abc');
    }

    public function testThrowExceptionIfEmptyStringProvided()
    {
        $this->expectException(InvalidNumberException::class);
        $this->sut->isValid('');
    }

    public function provideNumberWithValidity()
    {
        return [
            ['79927398713', true],
            ['79927398711', false],
            ['8961019501234400001', true],
            ['9501234400008', true],
            ['9501234400001', false],
            ['4556737586899855', true],
        ];
    }
}
