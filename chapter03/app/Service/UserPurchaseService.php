<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserPurchaseService
{
    protected $repository;

    /**
     * UserPurchaseService constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(
        UserRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param int $identifier
     *
     * @return User
     */
    public function retrievePurchase(int $identifier): User
    {
        $user = $this->repository->find($identifier);
        // 데이터베이스로부터 얻은 값을 사용한 처리 등
        $user = new User($user);
        return $user;
    }
}
