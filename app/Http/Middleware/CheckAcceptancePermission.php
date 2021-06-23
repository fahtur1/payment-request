<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAcceptancePermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->position->subposition->allowed_to_accept_request == false) {
            return redirect()->back();
        }
        return $next($request);
    }
}
