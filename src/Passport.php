<?php

namespace Tylerian\Lumen\Passport;

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport as AbstractPassport;
use Tylerian\Lumen\Support\Proxies\RouterProxy;

class Passport extends AbstractPassport
{
    /**
     * Binds the Passport routes into the controller.
     *
     * @param  callable|null  $callback
     * @param  array  $options
     * @return void
     */
    public static function routes($callback = null, array $options = [])
    {
        $callback = $callback ?: function ($router) {
            $router->all();
        };

        $defaultOptions = [
            'prefix' => 'oauth',
            'namespace' => '\Laravel\Passport\Http\Controllers',
        ];

        $options = array_merge($defaultOptions, $options);

        Route::group($options, function ($router) use ($callback) {
            $callback(new RouteRegistrar(new RouterProxy($router)));
        });
    }
}