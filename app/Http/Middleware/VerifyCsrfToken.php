<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        // Allow Railway health checks and other system requests
        if ($request->is('up') || $request->is('health')) {
            return true;
        }

        // For Railway deployment, be more permissive with CSRF
        if (app()->environment('production') && $request->is('login')) {
            // Log the request for debugging
            Log::info('CSRF check for login route', [
                'url' => $request->url(),
                'method' => $request->method(),
                'has_csrf_token' => $request->has('_token'),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return parent::inExceptArray($request);
    }
} 