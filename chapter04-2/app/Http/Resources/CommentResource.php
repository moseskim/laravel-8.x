<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use function sprintf;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource['id'],
            'body' => $this->resource['body'],
            "_links" => [
                'self' => [
                    'href' => sprintf(
                        'https://example.com/comments/%s',
                        $this->resource['id']
                    )
                ]
            ],
            '_embedded' => [
                'user' => new UserResource(
                    [
                        'user_id' => $this->resource['user_id'],
                        'user_name' => $this->resource['user_name']
                    ]
                )
            ],
        ];
    }
}
