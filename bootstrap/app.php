<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

use function Illuminate\Log\log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle authentication exceptions for API routes
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => "error",
                    'errors' => [
                        'generic' => 'Not authenticated'
                    ]
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }
        });
        $exceptions->render(function (Throwable $e, Request $request){
            Log::error($e);
if ($request->is('api/*')) {
                return response()->json([
                    'status' => "error",
                    'errors' => [
                        'generic' => 'UNkNOWN ERROR'
                    ]
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }
        });
    })
    ->create();
