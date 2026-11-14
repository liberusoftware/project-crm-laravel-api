<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
        $middleware->api(prepend: [
            \App\Http\Middleware\SetTenantContext::class,
            \App\Http\Middleware\SetPermissionsTeamContext::class,
        ]);
        $middleware->alias([
            'twilio.verify' => \App\Http\Middleware\VerifyTwilioRequest::class,
            'billing.access' => \App\Http\Middleware\EnsureBillingAccess::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(fn (Request $request): bool => $request->is('api/*') || $request->expectsJson());
    })->create();
