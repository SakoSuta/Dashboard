<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminPass
{
    public function handle($request, Closure $next)
    {
        // var_dump($request->user());
        // die();
        if ($request->user() || $request->user()->isAdmin) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}