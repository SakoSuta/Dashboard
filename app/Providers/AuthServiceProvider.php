<?php
namespace App\Providers;

use App\Guards\CustomTokenGuard;
use App\Providers\CustomUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // ...

    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('custom_token', function ($app, $name, array $config) {
            $provider = $app->make(\App\Providers\CustomUserProvider::class, ['authService' => $app->make(\App\Services\AuthService::class)]);
            $request = $app['request'];
            return new CustomTokenGuard($provider, $request);
        });

        Auth::provider('custom', function ($app, array $config) {
            return new CustomUserProvider($app->make(\App\Services\AuthService::class));
        });
    }
}