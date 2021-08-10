<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    /**
     * @param int $id
     *
     * @return Purchase
     */
    public static function findAllBy(int $id): self
    {
        return new static(
            [
                'id' => $id
            ]
        );
    }
}
