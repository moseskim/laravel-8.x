<?php

declare(strict_types=1);

namespace App\Foundation\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

use function hash_equals;
use function is_null;
use function sprintf;

class CacheUserProvider extends EloquentUserProvider
{
    protected $cache;
    protected $cacheKey = "authentication:user:%s";
    protected $lifetime;

    public function __construct(
        HasherContract $hasher,
        string $model,
        CacheRepository $cache,
        int $lifetime = 120
    ) {
        parent::__construct($hasher, $model);
        $this->cache = $cache;
        $this->lifetime = $lifetime;
    }

    public function retrieveById($identifier)
    {
        $cacheKey = sprintf($this->cacheKey, $identifier);
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        $result = parent::retrieveById($identifier);
        if (is_null($result)) {
            return null;
        }
        $this->cache->add($cacheKey, $result, $this->lifetime);
        return $result;
    }

    public function retrieveByToken($identifier, $token)
    {
        $model = $this->retrieveById($identifier);
        if (!$model) {
            return null;
        }

        $rememberToken = $model->getRememberToken();
        return $rememberToken && hash_equals($rememberToken, $token) ? $model : null;
    }
}
