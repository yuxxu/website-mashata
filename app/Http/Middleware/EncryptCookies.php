<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Indicates if cookies should be exempt from encryption.
     *
     * @var array<int, string>
     */
    protected $except = [];
}
