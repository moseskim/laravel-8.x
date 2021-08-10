<?php

declare(strict_types=1);

namespace App\Foundation\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

use function strval;
use function GuzzleHttp\json_decode;

final class AmazonProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopes = [
        'profile'
    ];

    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase('https://www.amazon.com/ap/oa', $state);
    }

    protected function getTokenUrl(): string
    {
        return 'https://api.amazon.com/auth/o2/token';
    }

    protected function getUserByToken($token): array
    {
        $response = $this->getHttpClient()
            ->get(
                'https://api.amazon.com/user/profile',
                [
                    'headers' => [
                        'x-amz-access-token' => $token,
                    ]
                ]
            );
        return json_decode(strval($response->getBody()), true);
    }

    protected function mapUserToObject(array $user): User
    {
        return (new User())->setRaw($user)->map(
            [
                'id' => $user['user_id'],
                'nickname' => $user['name'],
                'name' => $user['name'],
                'email' => $user['email'],
                'avatar' => '',
            ]
        );
    }

    protected function getTokenFields($code): array
    {
        return parent::getTokenFields($code) + [
                'grant_type' => 'authorization_code'
            ];
    }
}
