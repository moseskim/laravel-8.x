<?php

declare(strict_types=1);

namespace App\DataProvider\Database;

use Illuminate\Database\Eloquent\Model;

final class Tag extends Model
{
    /** @var string */
    protected $table = 'tags';

    public $timestamps = false;

    /** @var array */
    protected $fillable = [
        'tag_name',
        'created_at',
    ];
}
