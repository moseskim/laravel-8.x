<?php

declare(strict_types=1);

namespace App\Events;

final class ReviewRegistered
{
    private $id;
    private $title;
    private $content;
    private $userId;
    private $tags = [];
    private $createdAt;

    /**
     * ReviewRegistered constructor.
     *
     * @param int $id
     * @param string $title
     * @param string $content
     * @param int $userId
     * @param string $createdAt
     * @param array $tags
     */
    public function __construct(
        int $id,
        string $title,
        string $content,
        int $userId,
        string $createdAt,
        array $tags
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->tags = $tags;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAtEpoch(): string
    {
        $datetime = new \DateTime($this->createdAt);
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

    public function getUserId(): int
    {
        return $this->userId;
    }
}
