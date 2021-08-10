<?php

declare(strict_types=1);

namespace App\Gate;

use App\Models\User;

use function intval;

final class UserAccess
{
    /**
     * @param User $user
     * @param string $id
     *
     * @return bool
     */
    public function __invoke(User $user, string $id): bool
    {
        return intval($user->getAuthIdentifier()) === intval($id);
    }
}
