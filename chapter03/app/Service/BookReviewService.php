<?php
declare(strict_types=1);

namespace App\Service;

/**
 * Class BookReviewService
 * 서적 리뷰 클래스
 */
final class BookReviewService
{
    /**
     * 리뷰를 수행한다
     *
     * @param string $userId
     * @param string $bookId
     * @param string $body
     */
    public function addReview(
        string $userId,
        string $bookId,
        string $body
    ) {
        // 리뷰 저장
    }
}
