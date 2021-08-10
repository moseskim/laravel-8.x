<?php

declare(strict_types=1);

namespace App\DataProvider\Database;

use App\DataProvider\RegisterReviewProviderInterface;
use Illuminate\Database\DatabaseManager;

/**
 * RegisterReviewDataProvider
 */
class RegisterReviewDataProvider implements RegisterReviewProviderInterface
{
    /** @var DatabaseManager */
    protected $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        DatabaseManager $databaseManager
    ) {
        $this->databaseManager = $databaseManager;
    }

    /**
     * @param string $title
     * @param string $content
     * @param int $userId
     * @param string $createdAt
     * @param array $tags
     *
     * @return int
     * @throws \Throwable
     */
    public function save(
        string $title,
        string $content,
        int $userId,
        string $createdAt,
        array $tags = []
    ): int {
        $reviewId = $this->createReview($title, $content, $userId, $createdAt);
        foreach ($tags as $tag) {
            $this->createReviewTag(
                $reviewId,
                $this->createTags($tag, $createdAt),
                $createdAt
            );
        }
        return $reviewId;
    }

    /**
     * @param string $name
     * @param string $createdAt
     *
     * @return int
     */
    protected function createTags(string $name, string $createdAt): int
    {
        $result = Tag::firstOrCreate(
            [
                'tag_name' => $name
            ],
            [
                'created_at' => $createdAt
            ]
        );
        return $result->id;
    }

    /**
     * @param string $title
     * @param string $content
     * @param int $userId
     * @param string $createdAt
     *
     * @return int
     */
    protected function createReview(
        string $title,
        string $content,
        int $userId,
        string $createdAt
    ): int {
        $result = Review::firstOrCreate(
            [
                'user_id' => $userId,
                'title' => $title,
            ],
            [
                'content' => $content,
                'created_at' => $createdAt,
            ]
        );
        return $result->id;
    }

    protected function createReviewTag(int $reviewId, int $tagId, string $createdAt)
    {
        ReviewTag::firstOrCreate(
            [
                'tag_id' => $tagId,
                'review_id' => $reviewId,
            ],
            [
                'created_at' => $createdAt,
            ]
        );
    }
}
