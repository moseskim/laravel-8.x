<?php

declare(strict_types=1);

namespace App\Auth;

use Illuminate\Contracts\Auth\Authenticatable;

final class AuthenticateUser implements Authenticatable
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function getAuthIdentifierName(): string
    {
        return 'user_id';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes[$this->getAuthIdentifierName()];
    }

    public function getAuthPassword(): string
    {
        return $this->attributes['password'];
    }

    public function getRememberToken(): string
    {
        return $this->attributes[$this->getRememberTokenName()];
    }

    public function setRememberToken($value): void
    {
        $this->attributes[$this->getRememberTokenName()] = $value;
    }

    public function getRememberTokenName(): string
    {
        return '';
    }
}
