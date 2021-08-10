<?php

declare(strict_types=1);

namespace App\Providers;

use App\DataProvider\UserToken;
use App\Foundation\Auth\CacheUserProvider;
use App\Foundation\Auth\UserTokenProvider;
use App\Gate\UserAccess;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Psr\Log\LoggerInterface;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(
        GateContract $gate,
        LoggerInterface $logger
    ): void {
        $this->registerPolicies();
        $this->app->make('auth')->provider(
            'cache_eloquent',
            function (Application $app, array $config) {
                return new CacheUserProvider(
                    $app->make('hash'),
                    $config['model'],
                    $app->make('cache')->driver()
                );
            }
        );
        // ①
        $this->app->make('auth')->provider(
            'user_token',
            function (Application $app, array $config) {
                // ②
                return new UserTokenProvider(new UserToken($app->make('db')));
            }
        );

        $gate->define(
            'user-access',
            function (User $user, $id) {
                return intval($user->getAuthIdentifier()) === intval($id);
            }
        );

        // 리스트 6.5.2.4 __invoke를 구현한 메서드를 인가 처리에서 이용 시
        // $gate->define('user-access', new UserAccess());

        // 리스트 6.5.2.5 before 메서드를 이용한 인가 처리 로깅
        $gate->before(
            function ($user, $ability) use ($logger) {
                $logger->info(
                    $ability,
                    [
                        'user_id' => $user->getAuthIdentifier()
                    ]
                );
            }
        );
    }
}
