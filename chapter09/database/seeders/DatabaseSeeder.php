<?php

namespace Database\Seeders;

use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPoint;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        EloquentCustomer::create(
            [
                'id' => 1,
                'name' => 'name1',
            ]
        );
        EloquentCustomerPoint::create(
            [
                'customer_id' => 1,
                'point' => 100,
            ]
        );
    }
}
