<?php

declare(strict_types=1);

namespace App\DataProvider\Database;

use App\Entity\Tag;

use function intval;

/**
 * Class RetrieveReviewDataProvider
 */
class RetrieveReviewDataProvider
{
    /**
     * @param int $id
     *
     * @return \App\Entity\Review
     */
    public function retrieveReview(int $id): \App\Entity\Review
    {
        $result = Review::find($id);
        $reviewTag = new ReviewTag();
        $tags = [];
        foreach ($reviewTag->byReviewId(intval($result->id)) as $item) {
            $tags[] = (new Tag($item->id, $item->tag_name));
        }
        return new \App\Entity\Review(
            $result->id,
            $result->title,
            $result->content,
            $result->created_at,
            $tags
        );
    }
}
