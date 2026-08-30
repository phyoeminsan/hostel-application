<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectTo(
        guests: '/admin/login'
    );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (TokenMismatchException $e, $request) {
            return redirect()->route('login')->withErrors([
                'auth_failed' => 'Session သက်တမ်းကုန်သွားပါပြီ။ ကျေးဇူးပြု၍ ပြန်လည် Login ဝင်ပါ။'
            ]);
        });
    })->create();
