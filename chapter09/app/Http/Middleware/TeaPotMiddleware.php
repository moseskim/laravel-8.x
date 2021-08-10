<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;

class TeaPotMiddleware
{
    /**
     * @return never
     */
    public function handle($request, Closure $next)
    {
        abort(418);
    }
}
