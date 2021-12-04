<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function find(int $id): array
    {
        $user = User::find($id)->toArray();
        // 임의의 처리
        return $user;
    }
}
