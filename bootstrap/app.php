<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Você pode ter outros middlewares já definidos aqui pelo Breeze ou Laravel.
        // Exemplo: $middleware->web(append: [
        //     \App\Http\Middleware\TrustProxies::class,
        // ]);

        // Adicione seu middleware 'IsAdmin' como um 'alias' (apelido) de rota.
        // Isso permite que você use ->middleware('admin') em suas rotas.
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class, // <-- ADICIONE ESTA LINHA
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();