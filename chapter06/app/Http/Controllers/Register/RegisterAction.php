<?php

declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\Factory;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class RegisterAction extends Controller
{
    public function __invoke(Factory $factory): RedirectResponse
    {
// ①
        return $factory->driver('github')->redirect();
    }
}
