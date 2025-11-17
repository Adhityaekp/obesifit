<?php

namespace App\Http;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     */
    protected $middleware = [
        // Handles CORS, proxies, and maintenance mode
        // \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        // \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        // \Illuminate\Http\Middleware\TrustProxies::class,
        // \Illuminate\Http\Middleware\HandleCors::class,
        // // \Illuminate\Http\Middleware\TrimStrings::class,
        // \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];


    /**
     * The application's route middleware (aliases).
     *
     * These can be assigned to routes or controllers using their key.
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];

    /**
     * The application's middleware priority.
     *
     * This forces middleware to always run in a given order.
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        // \App\Http\Middleware\Authenticate::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Cek setiap hari jam 00:00
        $schedule->call(function () {
            $expired = Subscription::where('status', 'active')
                ->where('end_date', '<', now())
                ->update(['status' => 'expired']);

            Log::info("Expired {$expired} subscriptions at " . now());
        })->dailyAt('01:46');
    }
}
