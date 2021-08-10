<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $customer_id
 * @property int $point
 */
class EloquentCustomerPoint extends Model
{
    use HasFactory;

    protected $table = 'customer_points';
    public $timestamps = false;

    public function addPoint(int $customerId, int $point): bool
    {
        return $this->newQuery()
                ->where('customer_id', $customerId)
                ->increment('point', $point) === 1;
    }

    public function findPoint(int $customerId): int
    {
        return $this->newQuery()
            ->where('customer_id', $customerId)
            ->value('point');
    }
}
