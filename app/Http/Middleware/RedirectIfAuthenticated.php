<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('RedirectIfAuthenticated');
        // var_dump(Auth::check());
        // die();
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME)->with(['token' => session('token')]);
        }

        return $next($request);
    }
}