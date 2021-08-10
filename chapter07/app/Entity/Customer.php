<?php

declare(strict_types=1);

namespace App\Entity;

final class Customer
{
    public function getId(): int
    {
        return 0;
    }

    public function getStatus(): int
    {
        return 1;
    }

    public function disabledNotification(): bool
    {
        return true;
    }
}
