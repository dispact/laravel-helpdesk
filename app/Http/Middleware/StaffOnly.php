<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->is_staff()) {
            abort(404);
        }

        return $next($request);
    }
}
