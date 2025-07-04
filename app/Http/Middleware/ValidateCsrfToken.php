<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class ValidateCsrfToken extends Middleware
{
    protected $except = [
        //
    ];
}
