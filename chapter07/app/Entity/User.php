<?php

declare(strict_types=1);

namespace App\Entity;

use Illuminate\Contracts\Auth\Authenticatable;

final class User implements Authenticatable
{
    /** @var int */
    private $id;

    /** @var string */
    private $apiToken;

    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /**
     * User constructor.
     *
     * @param int $id
     * @param string $apiToken
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        int $id,
        string $apiToken,
        string $name,
        string $email,
        string $password = ''
    ) {
        $this->id = $id;
        $this->apiToken = $apiToken;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAuthIdentifierName()
    {
        return 'user_id';
    }

    public function getAuthIdentifier(): int
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken(): string
    {
        return '';
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName(): string
    {
        return '';
    }
}
