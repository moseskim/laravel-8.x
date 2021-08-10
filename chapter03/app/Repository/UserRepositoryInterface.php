<?php
declare(strict_types=1);

namespace App\Repository;

/**
 * Interface UserRepositoryInterface
 */
interface UserRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return array
     */
    public function find(int $id): array;
}
