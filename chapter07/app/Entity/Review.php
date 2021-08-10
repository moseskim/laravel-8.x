<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;

final class Review
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var string */
    private $content;

    /** @var array */
    private $tags = [];

    /** @var string */
    private $createdAt;

    /**
     * @param int $id
     * @param string $title
     * @param string $content
     * @param string $createdAt
     * @param array $tags
     */
    public function __construct(
        int $id,
        string $title,
        string $content,
        string $createdAt,
        array $tags
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getCreatedAtEpoch(): string
    {
        $datetime = new DateTime($this->createdAt);
        return $datetime->format('U');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTags(): array
    {
        return $this->tags;
    }
}
