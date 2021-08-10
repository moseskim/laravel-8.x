<?php

declare(strict_types=1);

namespace App\DataProvider;

/**
 * RegisterReviewProviderInterface
 */
interface RegisterReviewProviderInterface
{
    /**
     * @param string $title
     * @param string $content
     * @param int $userId
     * @param string $createdAt
     * @param array $tags
     *
     * @return int
     */
    public function save(
        string $title,
        string $content,
        int $userId,
        string $createdAt,
        array $tags = []
    ): int;
}
