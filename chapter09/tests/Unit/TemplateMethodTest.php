<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TemplateMethodTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        echo __METHOD__, PHP_EOL;
    }

    protected function setUp(): void
    {
        parent::setUp();
        echo __METHOD__, PHP_EOL;
    }

    /**
     * @test
     */
    public function 테스트_메서드_1()
    {
        echo __METHOD__, PHP_EOL;
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function 테스트_메서드_2()
    {
        echo __METHOD__, PHP_EOL;
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        echo __METHOD__, PHP_EOL;
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        echo __METHOD__, PHP_EOL;
    }
}
