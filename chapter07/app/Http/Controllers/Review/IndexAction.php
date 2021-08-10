<?php

declare(strict_types=1);

namespace App\Http\Controllers\Review;

use App\DataProvider\Elasticsearch\ReadReviewDataProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * readをelasticearchを利用する例
 */
final class IndexAction extends Controller
{
    /** @var  ReadReviewDataProvider */
    private $provider;

    /**
     * @param ReadReviewDataProvider $provider
     */
    public function __construct(
        ReadReviewDataProvider $provider
    ) {
        $this->provider = $provider;
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            $this->provider->findAllByTag(['Laravel'])
        );
    }
}
