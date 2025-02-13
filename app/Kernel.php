<?php
// app/Http/Kernel.php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        //...
        \App\Http\Middleware\OperatorMiddleware::class,
        \App\Http\Middleware\AdminMiddleware::class,
        \App\Http\Middleware\OperatorOrAdminMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'operator' => \App\Http\Middleware\OperatorMiddleware::class,
        'operator_or_admin' => \App\Http\Middleware\OperatorOrAdminMiddleware::class,
    ];
}
