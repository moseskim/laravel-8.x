<?php

declare(strict_types=1);

namespace App\DataProvider\Database;

use Illuminate\Database\Eloquent\Model;

final class ReviewTag extends Model
{
    /** @var string */
    protected $table = 'review_tags';

    public $timestamps = false;

    /** @var array */
    protected $fillable = [
        'review_id',
        'tag_id',
        'created_at',
    ];

    /**
     * @param int $reviewId
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function byReviewId(int $reviewId)
    {
        return $this->newQuery()
            ->join('reviews', 'review_tags.review_id', '=', 'reviews.id')
            ->join('tags', 'review_tags.tag_id', '=', 'tags.id')
            ->where('reviews.id', $reviewId)
            ->get(['tags.tag_name', 'tags.id']);
    }
}
