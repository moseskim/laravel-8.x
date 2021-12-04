<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\User;

final class UserService
{
    /**
     * @param string $id
     *
     * @return User
     */
    public function retrieveUser(string $id): User
    {
        return new User(
            [
                'id' => $id,
                'name' => 'Laravel',
            ]
        );
    }

    /**
     * @param string $id
     * @param string $name
     */
    public function activate(string $id, string $name): void
    {
        // 등록 처리 등
    }
}
