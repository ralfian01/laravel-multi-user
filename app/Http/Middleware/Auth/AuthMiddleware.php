<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    protected $validAuthType = [
        'key',
        'basic',
        'bearer',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $authType = 'basic'): Response
    {
        if (!in_array($authType, $this->validAuthType)) {
            return new Exception('Invalid authentication type');
        }

        switch ($authType) {
            case 'key':
                return (new Key)->handle($request, $next);
                break;
            case 'basic':
                return (new Basic)->handle($request, $next);
                break;
            case 'bearer':
                return (new Bearer)->handle($request, $next);
                break;
        }
    }
}
