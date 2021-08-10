<?php

declare(strict_types=1);

namespace App\DataTransfer;

/**
 * Class Book
 */
final class Book
{
    private $id;
    private $title;
    private $price;

    public function __construct(
        int $id,
        string $title,
        int $price
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
