<?php

declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GithubProvider;
use Psr\Log\LoggerInterface;

final class CallbackAction extends Controller
{
    public function __invoke(
        Factory $factory,
        AuthManager $authManager,
        LoggerInterface $log
    ) {
        // ①
        $user = $factory->driver('github')->user();
        // ②
        $authManager->guard()->login(
            User::firstOrCreate(
                [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => '',
                ]
            ),
            true
        );
        /** @var GithubProvider $driver */
        $driver = $factory->driver('github');
        $user = $driver->setHttpClient(
            new Client(
                [
                    'handler' => tap(
                        HandlerStack::create(),
                        function (HandlerStack $stack) use ($log) {
                            $stack->push(Middleware::log($log, new MessageFormatter()));
                        }
                    )
                ]
            )
        )->user();
        /*
        * Facade를 이용할 떄는 다음과 같이 기술한다
        */
        $user = Socialite::driver('github')->user();
        Auth::login(
            User::firstOrCreate(
                [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                ]
            ),
            true
        );

        return redirect('/home');
    }
}
