<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\PreconditionException;

final class CalculatePointService
{
    /**
     * @param int $amount
     * @return int
     * @throws PreconditionException
     */
    public static function calcPoint(int $amount): int
    {
        if ($amount < 0) {
            throw new PreconditionException('구매 금액이 음수');
        }
        if ($amount < 1000) {
            return 0;
        }
        if ($amount < 10000) {
            $basePoint = 1;
        } else {
            $basePoint = 2;
        }
        return intval($amount / 100) * $basePoint;
    }
}
