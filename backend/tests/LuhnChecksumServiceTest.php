<?php

declare(strict_types=1);

namespace App\Test;

use stdClass;
use TypeError;
use PHPUnit\Framework\TestCase;
use App\Services\LuhnChecksumService;
use App\Exceptions\LuhnChecksumException;

/**
 * Test LuhnChecksumService class
 */
class LuhnChecksumServiceTest extends TestCase
{
    /** @var LuhnChecksumService */
    private $service;

    /**
     * Phpunit setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->service = new LuhnChecksumService;
    }

    /**
     * Verify test throws TypeError when value is boolean
     *
     * @return void
     */
    public function testLuhnChecksumHandleBooleanFails(): void
    {
        $this->expectException(TypeError::class);

        $this->service->handle(false);
    }

    /**
     * Verify test throws TypeError when value is array
     *
     * @return void
     */
    public function testLuhnChecksumHandleArrayFails(): void
    {
        $this->expectException(TypeError::class);

        $this->service->handle([]);
    }

    /**
     * Verify test throws TypeError when value is object
     *
     * @return void
     */
    public function testLuhnChecksumHandleObjectFails(): void
    {
        $this->expectException(TypeError::class);

        $this->service->handle(new stdClass);
    }

    /**
     * Verify test throws TypeError when value is float
     *
     * @return void
     */
    public function testLuhnChecksumHandleFloatFails(): void
    {
        $this->expectException(TypeError::class);

        // valid number changed to invalid float
        $this->service->handle(45.32745982445057);
    }

    /**
     * Verify test throws LuhnChecksumException when value is a non-digit string
     *
     * @return void
     */
    public function testLuhnChecksumHandleBadStringFails(): void
    {
        $this->expectException(LuhnChecksumException::class);

        // valid number changed to invalid float
        $this->service->handle("test");
    }

    /**
     * Verify test fails as expected
     *
     * @return void
     */
    public function testLuhnChecksumIsInvalid(): void
    {
        // this number is known to be invalid
        $invalidTestNumber = "4532745982445056";
        $result = $this->service->handle($invalidTestNumber);
        $this->assertFalse($result);
    }

    /**
     * Verify test passes as expected
     *
     * @return void
     */
    public function testLuhnChecksum(): void
    {
        // this number is known to be valid
        $validTestNumber = "4532745982445057";
        $result = $this->service->handle($validTestNumber);
        $this->assertTrue($result);
    }
}