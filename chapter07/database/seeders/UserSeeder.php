<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\DatabaseManager;
use Illuminate\Contracts\Hashing\Hasher;

class UserSeeder extends Seeder
{
    /**
     * @param DatabaseManager $manager
     * @param Hasher $hasher
     */
    public function run(
        DatabaseManager $manager,
        Hasher $hasher
    ): void {
        $manager->table('users')
            ->insertGetId(
                [
                    'name' => 'laravel user',
                    'email' => 'mail@example.com',
                    'password' => $hasher->make('password'),
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]
            );
    }
}
