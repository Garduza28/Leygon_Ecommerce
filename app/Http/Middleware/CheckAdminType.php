<?php

namespace App\Http\Middleware;
use Closure;

class CheckAdminType
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type == 1) {
            return redirect('/admin/products');
        }

        return $next($request);
    }
}

