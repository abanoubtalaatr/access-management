<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class VerifyCsrfTokenMiddleware extends VerifyCsrfToken
{
    protected $except = [

        // '*', // Exclude all API routes from CSRF verification
    ];
}
