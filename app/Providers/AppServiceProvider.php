<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('api', function ($data) {
            return Response::json(
                [
                    'status' => 'success',
                    'data' => $data,
                ]
            );
        });

        // Session Flash Macro
        Response::macro('flash', function ($message, $type = 'success') {
            Session::flash('flash_message', [
                'message' => $message,
                'type' => $type
            ]);
            Session::flash('flash_test', [
                'message' => 'tested',
            ]);

        });
    }
}
