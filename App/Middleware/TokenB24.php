<?php

namespace App\Middleware;

use Closure;

class TokenB24
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (isset($request->auth['application_token'])) {
            try {
                if ($request->auth['application_token'] !== $_ENV['TOKEN_B24']) {
                    return 'Error: wrong token';
                }
            } catch (\Exception $e) {
                return 'Error: ' . $e->getMessage();
            }
        } else {
            return 'Error: no auth!';
        }

        return $next($request);
    }

}