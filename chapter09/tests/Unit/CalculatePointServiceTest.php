<?php

namespace Tests\Unit;

use App\Exceptions\PreconditionException;
use App\Services\CalculatePointService;
use PHPUnit\Framework\TestCase;

class CalculatePointServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function calcPoint_구매_금액이_0이면_포인트는_0()
    {
        $result = CalculatePointService::calcPoint(0);

        $this->assertSame(0, $result);
    }

    /**
     * @test
     */
    public function calcPoint_구매_금액이_10000이면_포인트는_10()
    {
        $result = CalculatePointService::calcPoint(10000);

        $this->assertSame(10, $result);
    }

    /**
     * @test
     * @dataProvider dataProvider_for_calcPoint
     */
    public function calcPoint(int $expected, int $amount)
    {
        $result = CalculatePointService::calcPoint($amount);

        $this->assertSame($expected, $result);
    }

    public function dataProvider_for_calcPoint()
    {
        return [
            '구매 금액이 0이면 0포인트' => [0, 0],
            '구매 금액이 9999이면 0포인트' => [0, 9999],
            '구매 금액이 10000이면 10포인트' => [10, 10000],
            '구매 금액이 99999이면 99포인트' => [99, 99999],
            '구매 금액이 100000이면 200포인트' => [200, 100000],
        ];
    }

    /**
     * @test
     */
    public function exception_try_catch()
    {
        try {
            throw new \InvalidArgumentException('message', 200);
        } catch (\Throwable $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
            $this->assertSame(200, $e->getCode());
            $this->assertSame('message', $e->getMessage());
        }
    }

    /**
     * @test
     */
    public function exception_expectException_method()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(200);
        $this->expectExceptionMessage('message');

        throw new \InvalidArgumentException('message', 200);
    }

    /**
     * @test
     */
    public function calcPoint_구매_금액이_음수이면_예외를_던짐()
    {
        $this->expectException(PreconditionException::class);
        $this->expectExceptionMessage('구매_금액이_음수');

        CalculatePointService::calcPoint(-1);
    }
}
