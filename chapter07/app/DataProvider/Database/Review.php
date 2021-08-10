<?php

declare(strict_types=1);

namespace App\DataProvider\Database;

use Illuminate\Database\Eloquent\Model;

final class Review extends Model
{
    /** @var string */
    protected $table = 'reviews';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'created_at',
    ];
}
