<?php

declare(strict_types=1);

namespace App\Services;

use App\DataProvider\PublisherRepositoryInterface;
use App\Domain\Entity\Publisher;

class PublisherService
{
    private $publisher;

    public function __construct(PublisherRepositoryInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    public function exists(string $name): bool
    {
        if (!$this->publisher->findbyName($name)) {
            return false;
        }
        return true;
    }

    public function store(string $name, string $address): int
    {
        return $this->publisher->store(new Publisher(null, $name, $address));
    }
}


